var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('web/build/')
    .setPublicPath('/web')
    .addEntry('app', './assets/js/app.js')
    .addEntry('main', './assets/scss/main.scss')
    .addEntry('event', './assets/css/style.css')
    .addEntry('inscription', './assets/scss/inscription.scss')
    .addEntry('compte', './assets/scss/compte.scss')
    .addEntry('validation', './assets/scss/validation.scss')
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSassLoader();

module.exports = Encore.getWebpackConfig();
