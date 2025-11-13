// gulpfile.js
const { watch, series, src, dest } = require('gulp');
const imagemin = require('gulp-imagemin');
const changed = require('gulp-changed').default;
const sass = require('gulp-sass')(require('sass'));
const tailwindcss = require('tailwindcss');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const browsersync = require("browser-sync").create();
const cleanCSS = require('gulp-clean-css');
const webpack = require('webpack-stream');
const rename = require('gulp-rename');
const sharpOptimizeImages = require('gulp-sharp-optimize-images').default;

const imgDest = './dist/images';

function browsersyncServer(cb) {
    browsersync.init({
        proxy: 'horsens.local',
        injectChanges: true,
        reloadOnRestart: true,
        open: false,
    });
    cb();
}

function browsersyncReload(cb) {
    browsersync.reload();
    cb();
}

async function cssTask() {
    return src('./src/scss/*.scss')
        .pipe(sass({ style: 'compressed'}, {}).on('error', sass.logError))
        .pipe(postcss([
            tailwindcss('./tailwind.config.js'),
            autoprefixer
        ]))
        .pipe(cleanCSS())
        .pipe(rename({
            suffix: '.min',
            extname: '.css',
        }))
        .pipe(dest('./dist/css'))
        .pipe(browsersync.stream());
}

function fontsTask() {
    return src('./src/fonts/**/*')
        .pipe(dest('./dist/fonts'))
        .pipe(browsersync.stream())
}

function jsTask() {
    return src('./src/js/main.js')
        .pipe(webpack({
            mode: 'production',
            output: {
                filename: 'bundle.js'
            },
            module: {
                rules: [
                    {
                        test: /\.js$/,
                        exclude: /node_modules/,
                        use: {
                            loader: 'babel-loader',
                            options: {
                                presets: ['@babel/preset-env']
                            }
                        }
                    }
                ]
            }
        }))
        .pipe(rename({ suffix: '.min' }))
        .pipe(dest('./dist/js')) 
        .pipe(browsersync.stream());
}

function imageTask() {
    return src('./src/images/**/*')
        .pipe(changed(imgDest))
        .pipe(sharpOptimizeImages({
            'jpg': {
            quality: 80,
            progressive: true,
            },
            'png': {
                quality: 90,
                compressionLevel: 8,
            },
            'gif': {},
            'webp': {
                quality: 80,
            }
        }))
        .pipe(imagemin())
        .pipe(dest(imgDest));
}

function watchTask() {
    watch(["src/scss/**/*.scss"], cssTask);
    watch(["src/fonts/**/*"], series(fontsTask, browsersyncReload));
    watch(["src/js/**/*.js"], series(jsTask, browsersyncReload));
    watch(["src/images/**/*"], series(imageTask, browsersyncReload));
    watch(["**/*.php", "./template-parts/**/*.php"], series(cssTask, browsersyncReload));
}

exports.css = cssTask;
exports.fonts = fontsTask;
exports.js = jsTask;
exports.sync = browsersyncServer;
exports.images = imageTask;
exports.watch = watchTask;

exports.default = series(cssTask, fontsTask, jsTask, imageTask, browsersyncServer, watchTask);