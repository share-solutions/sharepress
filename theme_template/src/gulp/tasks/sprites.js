var paths = require('./../gulppaths.json'),
    gulp = require('gulp'),
    buffer = require('vinyl-buffer'),
    imagemin = require('gulp-imagemin'),
    //imageminPngquant = require('imagemin-pngquant'),
    spritesmith = require('gulp.spritesmith');


gulp.task('sprites', function (done) {
    /*
    // Gera o sprite
    var spriteData = gulp.src(paths.input.sprites + '/*.png')
        .pipe(spritesmith({
            imgName: 'sprite.png',
            cssName: '_sprite.scss',
            imgPath: paths.output.cssimages + '/sprite.png'
        }));

    // Optimiza imagem e guarda-a
    var imgStream = spriteData.img
        .pipe(buffer())
        .pipe(imagemin({
            progressive      : true,
            optimizationLevel: 7,
            svgoPlugins      : [{removeViewBox: false}],
            //use              : [imageminPngquant()]
        }))
        .pipe(gulp.dest(paths.output.sprites));

    // Guarda SCSS com sprites
    var cssStream = spriteData.css
        .pipe(gulp.dest(paths.input.styles));

    */
    done();
});
