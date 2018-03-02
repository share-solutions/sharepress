var gulp = require('gulp'),
    php = require('gulp-connect-php'),
    browserSync = require('browser-sync');

gulp.task('php', function() {
    php.server({ base: './../../../', port: 8887, keepalive: true});
});
gulp.task('browser-sync', gulp.parallel('php', function() {
    browserSync({
        proxy: '127.0.0.1:8887',
        port: 8888,
        open: true,
        notify: false,
        injectChanges: true,
        files: [
            './build/**/*.css',
            './build/**/*.js',
            './build/**/*.png',
            './build/**/*.jpg',
            './build/**/*.gif',
            './build/**/*.svg',
            './build/**/*.woff',
            './build/**/*.woff2',
            './build/**/*.ttf',
            './build/**/*.otf',
            './build/**/*.eot',
            './src/**/*.php'
        ],
    });
}));