var gulp = require('gulp'),
  sass = require('gulp-sass'),
  bourbon = require('node-bourbon').includePaths,
  neat = require('node-neat').includePaths,
  concat = require('gulp-concat'),
  rename = require('gulp-rename'),
  uglify = require('gulp-uglify');

gulp.task('default', ['watch', 'styles', 'form', 'scripts', 'plugins']);

gulp.task('styles', function(){
  gulp.src('sass/style.sass')
    .pipe(sass({
      includePaths: [bourbon, neat],
      outputStyle: 'compressed',
      quiet: true
    }))
    .pipe(gulp.dest('css'));
});

gulp.task('form', function(){
  gulp.src('sass/form.sass')
    .pipe(sass({
      includePaths: [bourbon, neat],
      outputStyle: 'compressed',
      quiet: true
    }))
    .pipe(gulp.dest('css'));
});

gulp.task('scripts', function() {
  gulp.src('js/build/*.js')
    .pipe(concat('deploy.js'))
    .pipe(gulp.dest('js'));
});

gulp.task('plugins', function(){
  gulp.src('js/plugins/*.js')
    .pipe(concat('plugins.js', {newLine: '\n'}))
    .pipe(gulp.dest('js'))
    .pipe(rename('plugins.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('js'));
});

gulp.task('watch', function() {
  gulp.watch('sass/*.sass', ['styles']);
  gulp.watch('sass/form.sass', ['form']);
  gulp.watch('js/build/*.js', ['scripts']);
  gulp.watch('js/plugins/*.js', ['plugins']);
});
