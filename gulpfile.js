/*
 * 
 * Определяем переменные 
 *
 */

var gulp = require('gulp'), // Сообственно Gulp JS
    uglify = require('gulp-uglify'), // Минификация JS
    concat = require('gulp-concat'), // Склейка файлов
    imagemin = require('gulp-imagemin'), // Минификация изображений
    csso = require('gulp-csso'), // Минификация CSS
    sass = require('gulp-sass'); // Конверстация SASS (SCSS) в CSS

/*
 * 
 * Создаем задачи (таски) 
 *
 */

// Задача "sass". Запускается командой "gulp sass"
gulp.task('sass', function () {
    gulp.src('./public/assets/styles/style.scss') // файл, который обрабатываем
        .pipe(sass().on('error', sass.logError)) // конвертируем sass в css
        .pipe(csso()) // минифицируем css, полученный на предыдущем шаге
        .pipe(gulp.dest('public/css/')); // результат пишем по указанному адресу
});

// Задача "js". Запускается командой "gulp js"
gulp.task('js', function() {
    gulp.src([
        './public/assets/javascripts/jquery.js',
        './public/assets/javascripts/bootstrap.js',
        './public/assets/javascripts/script.js'
    ]) // файлы, которые обрабатываем
        .pipe(concat('min.js')) // склеиваем все JS
        .pipe(uglify()) // получившуюся "портянку" минифицируем
        .pipe(gulp.dest('public/js/')) // результат пишем по указанному адресу
});

// Задача "images". Запускается командой "gulp images"
gulp.task('images', function() {
    gulp.src('./public/assets/images/**/*') // берем любые файлы в папке и ее подпапках
        .pipe(imagemin()) // оптимизируем изображения для веба
        .pipe(gulp.dest('public/img/')) // результат пишем по указанному адресу

});

// Задача "watch". Запускается командой "gulp watch"
// Она следит за изменениями файлов и автоматически запускает другие задачи
gulp.task('watch', function () {
    // При изменение файлов *.scss в папке "styles" и подпапках запускаем задачу sass
    gulp.watch('./public/assets/styles/**/*.scss', ['sass']);
    // При изменение файлов *.js папке "javascripts" и подпапках запускаем задачу js
    gulp.watch('./public/assets/javascripts/**/*.js', ['js']);
    // При изменение любых файлов в папке "images" и подпапках запускаем задачу images
    gulp.watch('./public/assets/images/**/*', ['images']);
});