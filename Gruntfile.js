/* jshint node:true */
module.exports = function( grunt ) {
    'use strict';
    
    grunt.initConfig({

        pkg: grunt.file.readJSON( 'package.json' ),

        dirs: {
            demo: 'src/plugins/<%= pkg.name %>-demo',
            extensions: 'src/plugins/<%= pkg.name %>-extensions',
            theme: 'src/themes/<%= pkg.name %>',
            themeJS: 'src/themes/<%= pkg.name %>/assets/js',
            themeCSS: 'src/themes/<%= pkg.name %>/assets/css',
            themeSASS: 'src/themes/<%= pkg.name %>/assets/scss',
            childTheme: 'src/themes/<%= pkg.name %>-child'
        },

        // Minify .js files.
        terser: {
            options: {
                ecma: 5,
            },
            main: {
                files: [{
                    expand: true,
                    cwd: '<%= dirs.themeJS %>/',
                    src: [
                        'scripts.js'
                    ],
                    dest: '<%= dirs.themeJS %>',
                    ext: '.min.js'
                }]
            },
        },

        // Autoprefixer.
        postcss: {
            options: {
                processors: [
                    require( 'autoprefixer' )
                ]
            },
            dist: {
                src: [
                    '<%= dirs.theme %>/style.css'
                ]
            }
        },

        // Compile all .scss files.
        sass: {
            options: {
                implementation: require('node-sass'),
                sourceMap: false
            },
            dist: {
                files: [{
                    '<%= dirs.theme %>/style.css': '<%= dirs.theme %>/style.scss',
                    '<%= dirs.themeCSS %>/colors/green.css': '<%= dirs.themeSASS %>/colors/green.scss',
                    '<%= dirs.themeCSS %>/colors/blue.css': '<%= dirs.themeSASS %>/colors/blue.scss',
                    '<%= dirs.themeCSS %>/colors/blue.css': '<%= dirs.themeSASS %>/colors/blue.scss',
                    '<%= dirs.themeCSS %>/colors/red.css': '<%= dirs.themeSASS %>/colors/red.scss',
                    '<%= dirs.themeCSS %>/colors/pink.css': '<%= dirs.themeSASS %>/colors/pink.scss',
                    '<%= dirs.themeCSS %>/colors/orange.css': '<%= dirs.themeSASS %>/colors/orange.scss',
                    '<%= dirs.themeCSS %>/colors/purple.css': '<%= dirs.themeSASS %>/colors/purple.scss',
                    '<%= dirs.themeCSS %>/colors/gray.css': '<%= dirs.themeSASS %>/colors/gray.scss',
                    '<%= dirs.themeCSS %>/colors/navy.css': '<%= dirs.themeSASS %>/colors/navy.scss',
                    '<%= dirs.themeCSS %>/gutenberg-editor.css': '<%= dirs.themeSASS %>/gutenberg-editor.scss',
                }]
            }
        },

        // Check textdomain errors.
        checktextdomain: {
            options:{
                text_domain: '<%= pkg.name %>',
                keywords: [
                    '__:1,2d',
                    '_e:1,2d',
                    '_x:1,2c,3d',
                    'esc_html__:1,2d',
                    'esc_html_e:1,2d',
                    'esc_html_x:1,2c,3d',
                    'esc_attr__:1,2d',
                    'esc_attr_e:1,2d',
                    'esc_attr_x:1,2c,3d',
                    '_ex:1,2c,3d',
                    '_n:1,2,4d',
                    '_nx:1,2,4c,5d',
                    '_n_noop:1,2,3d',
                    '_nx_noop:1,2,3c,4d'
                ]
            },
            theme: {
                src:  [
                    '<%= dirs.theme %>/**/*.php', // Include all files
                    '!node_modules/**' // Exclude node_modules/
                ],
                expand: true
            },
            plugin: {
                options: {
                    text_domain: '<%= pkg.name %>-extensions'
                },
                src: [
                    '<%= dirs.extensions %>/**/*.php',
                    '!node_modules/**' // Exclude node_modules/
                ],
                expand: true
            }
        },

        // RTLCSS
        rtlcss: {
            options: {
                config: {
                    swapLeftRightInUrl: false,
                    swapLtrRtlInUrl: false,
                    autoRename: false,
                    preserveDirectives: true
                }
            },
            main: {
                expand: true,
                ext: '-rtl.css',
                src: [
                    '<%= dirs.theme %>/style.css',
                    '<%= dirs.themeCSS %>/gutenberg-editor.css',
                ]
            }
        },

        // Generate POT files.
        makepot: {
            options: {
                potHeaders: {
                    'report-msgid-bugs-to': 'https://madrasthemes.com/'
                }
            },
            frontend: {
                options: {
                    type: 'wp-theme',
                    cwd: '<%= dirs.theme %>/',
                    domainPath: 'languages',
                    potFilename: '<%= pkg.name %>.pot',
                    processPot: function ( pot ) {
                        pot.headers['project-id-version'];
                        return pot;
                    }
                }
            },
            plugins: {
                options: {
                    type: 'wp-plugin',
                    cwd: '<%= dirs.extensions %>/',
                    domainPath: 'languages',
                    potFilename: '<%= pkg.name %>-extensions.pot',
                    processPot: function ( pot ) {
                        pot.headers['project-id-version'];
                        return pot;
                    }
                }
            }
        },

        // Publish theme to GH Pages
        'gh-pages': {
            pages: {
                options: {
                    base : 'gh-pages'
                },
                src: ['**']
            },
            theme: {
                options: {
                    base : '<%= dirs.theme %>',
                    branch: 'theme',
                },
                src: ['**']
            },

        },

        version: {
            extension_plugin: {
                options: {
                    prefix: 'Version:\\s*\\s'
                },
                src: [ '<%= dirs.extensions %>/<%= pkg.name %>-extensions.php' ]
            },
            demo_plugin: {
                options: {
                    prefix: 'Version:\\s*\\s'
                },
                src: [ '<%= dirs.demo %>/<%= pkg.name %>-demo.php' ]
            },
            theme_sass: {
                options: {
                    prefix: 'Version:\\s*\\s'
                },
                src: [
                    '<%= dirs.theme %>/style.scss',
                ]
            },
            child_theme: {
                options: {
                    prefix: 'Version:\\s*\\s'
                },
                src: [ '<%= dirs.childTheme %>/style.css' ]
            }
        },

        // Clean previous deployed files
        clean: {
            dist: [
                '<%= pkg.name %>*.zip'
            ],
            files: '.grunt',
            demo: [
                '<%= pkg.name %>-demo.zip'
            ]
        },

        // make a zipfile
        compress: {
            demo_plugin: {
                options: {
                    archive: '<%= pkg.name %>-demo.zip'
                },
                files: [ {
                    expand: true,
                    cwd: '<%= dirs.demo %>',
                    dest: '<%= pkg.name %>-demo',
                    src: [
                        '**',
                        '!.*',
                        '!.*/**',
                        '.htaccess',
                        '!Gruntfile.js',
                        '!README.md',
                        '!package.json',
                        '!package-lock.json',
                        '!node_modules/**',
                        '!none',
                        '!.DS_Store',
                        '!npm-debug.log'
                    ]
                } ],
            },
            extension_plugin: {
                options: {
                    archive: '<%= pkg.name %>-extensions.zip'
                },
                files: [ {
                    expand: true,
                    cwd: '<%= dirs.extensions %>',
                    dest: '<%= pkg.name %>-extensions',
                    src: [
                        '**',
                        '!.*',
                        '!.*/**',
                        '.htaccess',
                        '!Gruntfile.js',
                        '!README.md',
                        '!package.json',
                        '!package-lock.json',
                        '!node_modules/**',
                        '!assets/esnext/**',
                        '!none',
                        '!.DS_Store',
                        '!npm-debug.log'
                    ]
                } ],
            },
            main: {
                options: {
                    archive: '<%= pkg.name %>.zip'
                },
                files: [ {
                    expand: true,
                    cwd: '<%= dirs.theme %>',
                    dest: '<%= pkg.name %>',
                    src: [
                        '**',
                        '!.*',
                        '!.*/**',
                        '.htaccess',
                        '!Gruntfile.js',
                        '!README.md',
                        '!package.json',
                        '!package-lock.json',
                        '!node_modules/**',
                        '!assets/esnext/**',
                        '!none',
                        '!.DS_Store',
                        '!npm-debug.log'
                    ]
                } ],
            },
            child: {
                options: {
                    archive: '<%= pkg.name %>-child.zip'
                },
                files: [ {
                    expand: true,
                    cwd: '<%= dirs.childTheme %>',
                    dest: '<%= pkg.name %>-child',
                    src: [
                        '**',
                        '!.*',
                        '!.*/**',
                        '.htaccess',
                        '!Gruntfile.js',
                        '!README.md',
                        '!package.json',
                        '!package-lock.json',
                        '!node_modules/**',
                        '!.DS_Store',
                        '!npm-debug.log'
                    ]
                } ],
            },
            build: {
                options: {
                    archive: '<%= pkg.name %>-v<%= pkg.version %>.zip'
                },
                files: [ {
                    expand: true,
                    cwd: 'dist/',
                    dest: '<%= pkg.name %>-v<%= pkg.version %>',
                    src: [
                        '**',
                        '!.*',
                        '!.*/**',
                        '.htaccess',
                        '!Gruntfile.js',
                        '!README.md',
                        '!package.json',
                        '!package-lock.json',
                        '!node_modules/**',
                        '!none',
                        '!.DS_Store',
                        '!npm-debug.log'
                    ]
                } ],
            }
        },

        // Creates deploy-able theme
        copy: {
            main: {
                files: [
                    { src: ['<%= pkg.name %>-extensions.zip'], dest: 'gh-pages/assets/plugins/'}
                ]
            },
            deploy: {
                files: [
                    { src: ['<%= pkg.name %>.zip'], dest: 'dist/theme-files/'},
                    { src: ['<%= pkg.name %>-child.zip'], dest: 'dist/theme-files/'},
                ]
            },
            changelog: {
                files: [
                    { expand: true, cwd: 'dist/', src: ['changelog.txt'], dest: 'gh-pages/'}
                ]
            }
        },


        // Minify all .css files.
        cssmin: {
            main: {
                files: {
                    '<%= dirs.theme %>/style.min.css': ['<%= dirs.theme %>/style.css'],
                    '<%= dirs.theme %>/style.min-rtl.css': ['<%= dirs.theme %>/style-rtl.css']
                }
            }
        }
    });

    // Load NPM tasks to be used here
    grunt.loadNpmTasks( 'grunt-contrib-jshint' );
    grunt.loadNpmTasks( 'grunt-terser' );
    grunt.loadNpmTasks( 'grunt-postcss' );
    grunt.loadNpmTasks( 'grunt-sass' );
    grunt.loadNpmTasks( 'grunt-contrib-cssmin' );
    grunt.loadNpmTasks( 'grunt-contrib-watch' );
    grunt.loadNpmTasks( 'grunt-rtlcss' );
    grunt.loadNpmTasks( 'grunt-wp-i18n' );
    grunt.loadNpmTasks( 'grunt-checktextdomain' );
    grunt.loadNpmTasks( 'grunt-version' );
    grunt.loadNpmTasks( 'grunt-contrib-clean' );
    grunt.loadNpmTasks( 'grunt-contrib-copy' );
    grunt.loadNpmTasks( 'grunt-contrib-compress' );
    grunt.loadNpmTasks( 'grunt-gh-pages' );

    grunt.registerTask( 'default', [
        'css',
        'js'
    ]);

    grunt.registerTask( 'js', [
        'terser'
    ]);

    grunt.registerTask( 'css', [
        'sass',
        'rtlcss',
        'postcss',
        'cssmin'
    ]);

    grunt.registerTask( 'publish', [
        'gh-pages:pages',
        'clean:files'
    ]);

    grunt.registerTask( 'publishtheme', [
        'gh-pages:theme',
        'clean:files'
    ]);

    grunt.registerTask( 'dev', [
        'default',
        'checktextdomain',
        'makepot'
    ]);

    grunt.registerTask( 'deploy', [
        'clean:dist',
        'compress:extension_plugin',
        'compress:demo_plugin',
        'copy:main',
        'compress:main',
        'compress:child',
        'copy:deploy',
        'copy:changelog'
    ]);

    grunt.registerTask( 'build', [
        'deploy',
        'compress:build'
    ]);
};