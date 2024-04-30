const { src, dest, watch, parallel } = require ('gulp');

    // CSS
const sass = require("gulp-sass")(require('sass'));
const plumber = require('gulp-plumber');

// Images
const cache = require('gulp-cache');
const imagemin = require('gulp-imagemin');
const webp = require('gulp-webp');

function versionWebp(done) {
    const options = {
        quality: 50
    };

    src('src/img/**/*.{png,jpg,jpeg}')
        .pipe(webp(options))
        .pipe(dest('build/img')) 

    done();
}

function images(done) {
    const options = {
        optimizationLevel: 3
    }
    src('src/img/**/*.{png,jpg}')
        .pipe( cache(imagemin(options) ))
        .pipe(dest('build/img'))

    done();
}

function css(done) {
    src("src/scss/**/*.scss")
        .pipe(plumber())
        .pipe(sass())
        .pipe(dest("build/css"))
        
    done()
}

function javascript(done) {
    src('src/js/**/*.js')
        .pipe(dest('build/js'));
    done();
}



function dev(done) {
    watch("src/scss/**/*.scss", css)
    watch("src/js/**/*.js", javascript)
    done();
}

    exports.css = css;
    exports.versionWebp = versionWebp;
    exports.images = images;
    exports.js = javascript;
    exports.dev = parallel(images, versionWebp, javascript, dev);