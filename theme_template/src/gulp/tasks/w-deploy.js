var gulp  = require('gulp');

gulp.task('beforeDeploy', gulp.series('cleanup', 'dropins', 'styles', 'scripts', 'fonts', 'images'));