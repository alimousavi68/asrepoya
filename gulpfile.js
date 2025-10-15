const gulp = require('gulp');
const cleanCSS = require('gulp-clean-css');
const rename = require('gulp-rename');
const sourcemaps = require('gulp-sourcemaps');
const autoprefixer = require('gulp-autoprefixer');
const sass = require('gulp-sass')(require('sass'));

// مسیرهای فایل‌ها
const paths = {
    css: {
        src: 'assets/css/main.css',
        dest: 'assets/css/',
        watch: 'assets/css/**/*.css'
    },
    scss: {
        src: 'assets/scss/**/*.scss',
        dest: 'assets/css/'
    }
};

// تسک مینیفای CSS
function minifyCSS() {
    return gulp.src(paths.css.src)
        .pipe(sourcemaps.init())
        .pipe(autoprefixer({
            cascade: false
        }))
        .pipe(cleanCSS({
            level: 2,
            compatibility: 'ie8'
        }))
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(paths.css.dest));
}

// تسک کامپایل SCSS (اختیاری)
function compileSCSS() {
    return gulp.src(paths.scss.src)
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer({
            cascade: false
        }))
        .pipe(gulp.dest(paths.scss.dest))
        .pipe(cleanCSS({
            level: 2
        }))
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(paths.scss.dest));
}

// تسک Watch
function watchFiles() {
    gulp.watch(paths.css.watch, minifyCSS);
    gulp.watch(paths.scss.src, compileSCSS);
}

// تسک‌های عمومی
exports.css = minifyCSS;
exports.scss = compileSCSS;
exports.watch = watchFiles;
exports.default = gulp.series(minifyCSS, watchFiles);