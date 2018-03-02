var gulp = require('gulp'),
    execAsync = require('./../lib/exec-async'),
    padNumber = require('./../lib/num-helpers').padNumber

var now = new Date()
var gitTag = `deploy-${now.getFullYear()}${padNumber(now.getMonth() + 1, "00")}${padNumber(now.getDate(), "00")}_${padNumber(now.getHours(), "00")}${padNumber(now.getMinutes(), "00")}${padNumber(now.getSeconds(), "00")}`

gulp.task('add-deploy-tag-to-last-commit', function (done) {
    var gitLastCommitId = `git log -n1 --format="%h"`
    var gitTagLastCommitCmd = `git tag -m "Automated Deploy Tag ${gitTag}" -a ${gitTag} <commitId>`;
    var gitPushTagsCmd = `git push --tags origin master`
    //`git tag --delete ${gitTag}`
    execAsync(gitLastCommitId)
        .then(function (commitId) {
            gitTagLastCommitCmd = gitTagLastCommitCmd.replace(/\<commitId\>/g, commitId)
            //console.log (gitTagLastCommitCmd)
            return execAsync(gitTagLastCommitCmd)
        })
        .then(function(res) {
            //console.log (res)
            console.log ("\n!!Try to Push new Tags to remote!!\n")
            return execAsync(gitPushTagsCmd)
        })
        .then(function(res) {
            done()
        })
        .catch(function (err, error) {
            console.log (err)
            done()
        })
})