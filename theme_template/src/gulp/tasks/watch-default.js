var paths = require('./../gulppaths.json'),
    gulp  = require('gulp'),
    browserSync  = require('browser-sync'); // Asynchronous browser loading on .scss file changes

/**
 * Default/Watch
 */

// Task default, inicia watchers
gulp.task('default', gulp.parallel('dropins', 'styles', 'scripts', 'images', 'sprites', 'fonts', 'browser-sync', function() {
    // Watcher de dropins
    gulp.watch(paths.input.dropins + '/**', gulp.parallel('dropins'));

    // Watcher de styles
    gulp.watch(paths.input.styles + '/**', gulp.parallel('styles'));

    // Watcher de scripts
    gulp.watch(paths.input.scripts + '/**', gulp.parallel('scripts'));

    // Watcher de imagens
    gulp.watch(paths.input.images + '/**', gulp.parallel('images'));

    // Watcher de sprites
    gulp.watch(paths.input.sprites + '/**', gulp.parallel('sprites'));

    // Watcher de fontes
    gulp.watch(paths.input.fonts + '/**', gulp.parallel('fonts'));

}));