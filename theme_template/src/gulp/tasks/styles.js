var paths = require('./../gulppaths.json'),
    gulp  = require('gulp'),
    gulpif = require('gulp-if'),
    sourcemaps = require('gulp-sourcemaps'),
    rev = require('gulp-rev'),
    revDel = require('rev-del'),
    sass = require('gulp-sass'),
    bulksass = require('gulp-sass-bulk-import'),
    cleancss = require('gulp-clean-css');

var deploy = process.env.NODE_ENV === 'production'

gulp.task('styles', function() {
    return gulp.src(paths.input.styles + '/[^_]*.scss')
        .pipe(bulksass())
        .pipe(gulpif(!deploy, sourcemaps.init()))
        .pipe(sass({
            includePaths: ['./styles']
        }).on('error', sass.logError))
        .pipe(gulpif(deploy, cleancss()))
        .pipe(rev())
        .pipe(gulpif(!deploy, sourcemaps.write('/sourcemaps')))
        .pipe(gulp.dest(paths.output.styles))
        .pipe(rev.manifest())
        .pipe(revDel({
            force: true,
            dest: paths.output.styles,
            deleteMapExtensions: true
        }))
        .pipe(gulp.dest(paths.output.styles));
});