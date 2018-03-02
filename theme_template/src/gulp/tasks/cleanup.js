var paths = require('../gulppaths.json'),
    gulp  = require('gulp'),
    del = require('del');

gulp.task('cleanup', function() {
    return del([
        paths.output.build + '/dropins/**',
        paths.output.build + '/scripts/**',
        paths.output.build + '/styles/**',
        paths.output.build + '/images/**',
        paths.output.build + '/fonts/**',
    ]);
});