var paths = require('./../gulppaths.json'),
    gulp  = require('gulp'),
    imagemin = require('gulp-imagemin'),
    imageminMozjpeg = require('imagemin-mozjpeg'),
    imageminPngquant = require('imagemin-pngquant');

gulp.task('images', function() {
    return gulp.src(paths.input.images + '/**')
        .pipe(imagemin([
            imagemin.gifsicle({interlaced: true}),
            imageminMozjpeg({
                quality: 75,
                progressive: true
            }),
            imageminPngquant({quality: "75"}),
            imagemin.svgo({
                plugins: [
                    {removeViewBox: true},
                    {cleanupIDs: false}
                ]
            })
        ]))
        .pipe(gulp.dest(paths.output.images));
});