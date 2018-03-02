var paths = require('./../gulppaths.json');

// Módulos comuns
var gulp  = require('gulp'),
    gulpif = require('gulp-if'),
    babel = require('gulp-babel'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    rev = require('gulp-rev'),
    revDel = require('rev-del'),
    reactPreset = require('babel-preset-react'),
    es2015Preset = require('babel-preset-es2015'),


    buffer = require('vinyl-buffer'),
    browserify = require('browserify'),
    globify = require('require-globify'),
    babelify = require('babelify'),
    //reactPreset = require('babel-preset-react'),
    //es2015Preset = require('babel-preset-es2015'),
    tap = require('gulp-tap')
    //uglify = require('gulp-uglify'),

    , notify = require('gulp-notify')


var deploy = process.env.NODE_ENV === 'production'


// Rotinas adicionais / error handling
function handleErrors () {
    var args = Array.prototype.slice.call(arguments)
    notify.onError({
        title: 'Compile Error',
        message: '<%= error.message %>'
    }).apply(this, args)
    this.emit('end') // Keep gulp from hanging on this task
}

// TODO: https://github.com/sogko/gulp-recipes/blob/master/browserify-separating-app-and-vendor-bundles/gulpfile.js

// Scripts
gulp.task('scripts', function() {
    var maps = !deploy

    return gulp.src(paths.input.scripts + '/[^_]*.js')
        .pipe(tap(function (file) {
            // replace file contents with browserify's bundle stream
            file.contents = browserify(file.path, {
                debug: maps,
                transform: [
                    babelify.configure({
                        presets: [es2015Preset, reactPreset],
                        plugins: ['transform-object-rest-spread', 'transform-decorators-legacy']
                    }),
                    globify
                ]
            })
                .bundle()
                .on('error', handleErrors)
        }))
        .pipe(buffer())
        .pipe(gulpif(deploy, uglify()))
        .pipe(rev())
        .pipe(gulp.dest(paths.output.scripts))
        .pipe(rev.manifest())
        .pipe(revDel({
            force: true,
            dest: paths.output.scripts,
            deleteMapExtensions: true
        }))
        .pipe(gulp.dest(paths.output.scripts));
});