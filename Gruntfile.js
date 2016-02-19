module.exports = function (grunt) {

		grunt.initConfig({
				pkg: grunt.file.readJSON('package.json'),

				/**
				 * Sass
				 **/
				sass: {
						dev: {
								options: {
										style: 'expanded',
										sourcemap: 'none'
								},
								files: {
										'compiled/style-expanded.css': 'sass/style.scss'
								}
						},
						dist: {
								options: {
										style: 'expanded',
										sourcemap: 'none'
								},
								files: {
										'compiled/style.css': 'sass/style.scss'
								}
						}
				},

				autoprefixer: {
						options: {
								browsers: ['last 2 versions']
						},
						multiple_files: {
								expand: true,
								flatten: true,
								src: 'compiled/*.css',
								dest: ''
						}
				},

				/**
				 * Watch
				 **/
				watch: {
						css: {
								files: '**/*.scss',
								tasks: ['sass', 'autoprefixer']
						}
				}
		});

		grunt.loadNpmTasks('grunt-contrib-sass');
		grunt.loadNpmTasks('grunt-contrib-watch');
		grunt.loadNpmTasks('grunt-autoprefixer');
		grunt.registerTask('default', ['watch']);

};
