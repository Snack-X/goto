module.exports = function(grunt) {
	grunt.initConfig({
		jshint: {
			all: [
				"Gruntfile.js",
				"public_html/assets/js/page_travel_create.js",
				"public_html/assets/js/page_write_checkin.js",
				"public_html/assets/js/page_admin_index.js"
			]
		},
		uglify: {
			my_target: {
				files: {
					"public_html/assets/js/page_travel_create.min.js": ["public_html/assets/js/page_travel_create.js"],
					"public_html/assets/js/page_write_checkin.min.js": ["public_html/assets/js/page_write_checkin.js"],
					"public_html/assets/js/page_admin_index.min.js": ["public_html/assets/js/page_admin_index.js"]
				}
			}
		},
		cssmin: {
			my_target: {
				files: {
					"public_html/assets/css/geomicons.min.css": ["public_html/assets/css/geomicons.css"],
					"public_html/assets/css/page_admin.min.css": ["public_html/assets/css/page_admin.css"],
					"public_html/assets/css/page_error.min.css": ["public_html/assets/css/page_error.css"],
					"public_html/assets/css/page_global.min.css": ["public_html/assets/css/page_global.css"],
					"public_html/assets/css/page_public.min.css": ["public_html/assets/css/page_public.css"]
				}
			}
		}
	});

	grunt.loadNpmTasks("grunt-contrib-jshint");
	grunt.loadNpmTasks("grunt-contrib-uglify");
	grunt.loadNpmTasks("grunt-contrib-cssmin");

	grunt.registerTask("default", ["jshint", "uglify", "cssmin"]);
};