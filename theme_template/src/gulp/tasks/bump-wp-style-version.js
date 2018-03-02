var gulp = require('gulp'),
    readFileAsync = require('./../lib/fs-helpers').readFileAsync,
    writeFileAsync = require('./../lib/fs-helpers').writeFileAsync

var themeBasePath = process.cwd() + '/'

gulp.task('bump-wp-style-version', function (done) {
    readFileAsync(`${themeBasePath}style.css`, 'utf-8')
        .then (function (res) {
            var lineParts, versionComponents
            var newContents = res.split("\n").map(function (line) {
                lineParts = line.split(":")
                if(lineParts[0] === "Version") {
                    versionComponents = lineParts[1].split(".").map(Number)
                    versionComponents[versionComponents.length - 1] = versionComponents[versionComponents.length - 1] + 1
                    console.info (`\nNew Version Identifier: ${versionComponents.join(".")}\n`)
                    return "Version: " + versionComponents.join(".")
                }
                return line
            }).join("\n")
            return writeFileAsync(`${themeBasePath}style.css`, newContents)
        })
        .then(function (res) {
            done()
        })
        .catch(function (err) {
            console.error (err)
            done()
        })
})