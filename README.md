# Mumble Soundboard
An online web application that connects to the [Mumble](https://github.com/mumble-voip/mumble) chat client to play localized audio files.

![bootstrap logo](https://user-images.githubusercontent.com/10498583/31125543-e2a88c2c-a848-11e7-87b0-d20ea38d41d0.jpg)
![sass logo](https://user-images.githubusercontent.com/10498583/31125541-e2a732e6-a848-11e7-959d-7d7b0c138124.jpg)
![gulp logo](https://user-images.githubusercontent.com/10498583/31125542-e2a78b88-a848-11e7-8ac5-c396f46e811f.jpg)
![browsersync logo](https://user-images.githubusercontent.com/10498583/31125540-e2a6eed0-a848-11e7-817a-69c5619f772a.jpg)

## Quick Start
```
# 1 Clone this repo
git clone https://github.com/nugentmichael/mumble-soundboard.git

# 2 Navigate into the repo directory
cd mumble-soundboard

# 3 Install all node packages
npm install

# 4 Get started
gulp serve - starts localhost server with browser-sync, watches HTML, Sass, JS with hot reloading
gulp - minify CSS/JS and builds your app into the dist directory, ready for production
```

## Requirements
This project requires you have [nodejs](https://nodejs.org/en/) with [npm](https://www.npmjs.com/get-npm) installed.
This project requires you have a global installation of [gulp](http://gulpjs.com/).
```
# Install gulp globally
npm install -g gulp
```

## Gulp commands
**gulp serve**

The gulp serve command starts a local Browsersync server that serves your files in the browser.
It reloads the current page when changing HTML, PHP, Sass and JS files.
The output of all Sass files go to main.css
All JS files are concatenated into main.js
You can access the development server with other devices on the same network. Go to the "External" address specified by Browsersync (see the terminal) in the web browser of your device.
```
gulp serve
```

**gulp (build)**

The default gulp command is set to creating a "dist" directory with a production version of the project, ready to be deployed.
It minifies and renames JS/CSS assets as well as cleaning the old "dist" directory. CSS is autoprefixed for the latest two browser versions.
```
gulp
```

**gulp concatScripts**

The gulp concatScripts command combines the specified JS resources into main.js
You can add new JS files to this command on line 16 in gulpfile.js
You might want to run concatScripts once separately after adding new JS files.
```
gulp concatScripts
```

## PHP
This web application utilizes the PHP language framework.