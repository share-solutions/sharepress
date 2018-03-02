var fs = require('fs'),
    gulp = require('gulp'),
    execAsync = require('./../lib/exec-async'),
    del = require('del'),
    //yazl = require("yazl"), // https://github.com/thejoshwolfe/yazl Yet Another Zip Library
    ftpClient = require('ftp'),
    putIncludedFoldersToTextFiles = require('./../lib/fs-helpers').putIncludedFoldersToTextFiles,
    readFileAsync = require('./../lib/fs-helpers').readFileAsync,
    getLast2CommitsWithTags = require('./../lib/git-helpers').getLast2CommitsWithTags,
    padNumber = require('./../lib/num-helpers').padNumber;

var projectBasePath = process.cwd() + '/../../../',
    now = new Date(),
    filesToClean = [],
    deploysFolder = "deploys/",
    deployIgnore = `${projectBasePath}.deployignore`,
    deployIncludes = `${projectBasePath}.deployinclude`,
    deployFtp = `${projectBasePath}.deployftp`
var zipFile = `deploy-${now.getFullYear()}${padNumber(now.getMonth() + 1, "00")}${padNumber(now.getDate(), "00")}_${padNumber(now.getHours(), "00")}${padNumber(now.getMinutes(), "00")}${padNumber(now.getSeconds(), "00")}.zip`

var ftpZipToPipe = function (zipFile, ftpConfig) {
    return new Promise(function (resolve, reject) {
        var fileBasename = zipFile.split("/")
        fileBasename = fileBasename[fileBasename.length - 1]
        var ftpConnection = new ftpClient();
        ftpConnection.on('ready', function () {
            ftpConnection.put(zipFile, `${ftpConfig.base_dir}${fileBasename}`, function (err) {
                if (err) reject() //throw err;
                ftpConnection.end();
                resolve()
            });
        });
        ftpConnection.connect({
            host    : ftpConfig.host,
            user    : ftpConfig.user,
            password: ftpConfig.pwd,
        });
    })
}

gulp.task('pack', gulp.series('bump-wp-style-version', function pack(done) {
    var gitTagsListCmd = `git tag --list deploy-*`,
        gitDiffTreeCmd = "git diff-tree -r --no-commit-id --name-only --diff-filter=ACMRT [previousCommit] [lastCommit]",
        ftpConfig = {}
    //
    // Start packing
    //
    // get deploy tags list
    execAsync(gitTagsListCmd)
        .then(function (contents) {
            var deployTags = contents.split("\n").reverse()
            deployTags.shift() // the git command list comes always with an empty line in the end
            deployTags.map(function (item) {
                //execAsync(`git tag --delete ${item}`)
            })
            // get last 2 commits with deploy tags
            return getLast2CommitsWithTags(deployTags)
        })
        .then(function (commits) {
            // replace commit ids in git diff command
            gitDiffTreeCmd = gitDiffTreeCmd.replace(/\[lastCommit\]/g, commits[0])
            gitDiffTreeCmd = gitDiffTreeCmd.replace(/\[previousCommit\]/g, commits[1])
            // read .deployignore
            return readFileAsync(deployIgnore, "utf-8")
        })
        .then(function (contents) {
            // compose git-diff command with grep cmd to exclude ignored directives
            contents.split("\n").map(function (item) {
                gitDiffTreeCmd += ` | grep -v "${item}"`
            })
            gitDiffTreeCmd += ` > ${projectBasePath}diff.txt`
            // add diff.txt file to cleanup files
            filesToClean.push(`${projectBasePath}diff.txt`)
            return execAsync(gitDiffTreeCmd, {})
        })
        .then(function () {
            return readFileAsync(deployIncludes, "utf-8")
        })
        .then(function (contents) {
            return putIncludedFoldersToTextFiles(projectBasePath, contents.split("\n"))
        })
        .then(function (filelistsToInclude) {
            var catCmd = `cd ${projectBasePath} && mkdir -p ${deploysFolder} && cat diff.txt`
            filelistsToInclude.map(function (item) {
                catCmd += " " + item
                filesToClean.push(projectBasePath + item)
            })
            return execAsync(`${catCmd} | zip -@ ${deploysFolder}${zipFile}`)
        })
        .then(function () {
            del(filesToClean, {force: true});
            return readFileAsync(deployFtp, "utf-8")
        })
        .then(function (contents) {
            var configParts;
            contents.split("\n").map(function (item) {
                configParts = item.split("=")
                ftpConfig[String(configParts[0]).toLowerCase()] = configParts[1]
            })
            return ftpZipToPipe(projectBasePath + zipFile, ftpConfig)
        })
        .then(function () {
            var fileBasename = zipFile.split("/")
            fileBasename = fileBasename[fileBasename.length - 1]
            console.info(`\nFile uploaded at: ${ftpConfig.url}${fileBasename}\n`)
            done()
        })
        .catch(function (err, error) {
            console.error(err, error)
            done()
        })
}));