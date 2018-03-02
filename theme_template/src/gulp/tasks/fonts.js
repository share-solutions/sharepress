var paths = require('./../gulppaths.json'),
    gulp  = require('gulp');

gulp.task('fonts', function () {
    return gulp.src(paths.input.fonts + '/**')
        .pipe(gulp.dest(paths.output.fonts));
});