var paths = require('./../gulppaths.json');

// Módulos comuns
var gulp  = require('gulp'),
    rev = require('gulp-rev')

// Dropins
gulp.task('dropins', function() {
    return gulp.src(paths.input.dropins + '/**/[^_]*')
        .pipe(rev())
        .pipe(gulp.dest(paths.output.dropins))
        .pipe(rev.manifest())
        .pipe(gulp.dest(paths.output.dropins));
});