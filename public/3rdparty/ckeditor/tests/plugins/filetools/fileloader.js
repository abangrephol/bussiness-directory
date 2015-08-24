/* bender-tags: editor,unit,clipboard,filetools */
/* bender-ckeditor-plugins: filetools */

'use strict';

( function() {
	var FileReaderBackup = window.FileReader,
		XMLHttpRequestBackup = window.XMLHttpRequest,
		FileLoader, resumeAfter,
		pngBase64 = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAIAAACQd1PeAAAAAXNSR0IArs4c6QAAAAxJREFUCNdjYGBgAAAABAABJzQnCgAAAABJRU5ErkJggg==',
		testFile, lastFormData,
		listeners = [],
		editorMock = {
			config: {}
		},
		editorMockDefaultFileName = {
			config: {
				fileTools_defaultFileName: 'default-file-name'
			}
		};

	function createFileReaderMock( scenario ) {
		var isAborted = false;

		window.FileReader = function() {
			var reader = {
					readAsDataURL: function() {
						for ( var i = 0; i < scenario.length; i++ ) {
							if ( !isAborted ) {
								( function( i ) {
									var action;
									if ( typeof scenario[ i ] === 'string' ) {
										action = function() {
											var evt;

											switch ( scenario[ i ] ) {
												case 'progress':
													evt = { loaded: 41 };
													break;
												case 'load':
													reader.result = 'result';
													break;
											}

											reader[ 'on' + scenario[ i ] ]( evt );
										};
									} else {
										action = scenario[ i ];
									}

									setTimeout( action, i );
								} )( i );
							}
						}
					},

					abort: function() {
						isAborted = true;
						reader.onabort();
					}
				};

			return reader;
		};
	}

	function createXMLHttpRequestMock( scenario, response ) {
		var isAborted = false;

		window.XMLHttpRequest = function() {
			var xhr = {
					open: function() {
					},

					send: function( formData ) {
						lastFormData = formData;

						for ( var i = 0; i < scenario.length; i++ ) {
							if ( !isAborted ) {
								( function( i ) {
									var action;
									if ( typeof scenario[ i ] === 'string' ) {
										action = function() {
											var evt;

											switch ( scenario[ i ] ) {
												case 'progress':
													evt = { loaded: 41 };
													break;
												case 'load':
													xhr.status = ( response && response.responseStatus ) ? response.responseStatus : 200;
													xhr.responseText = ( response && response.responseText ) ? response.responseText :
														'{"fileName":"name2.png","uploaded":1,"url":"http:\/\/url\/name2.png"}';
													break;
											}

											xhr[ 'on' + scenario[ i ] ]( evt );
										};
									} else {
										action = scenario[ i ];
									}

									setTimeout( action, i );
								} )( i );
							}
						}
					},

					abort: function() {
						isAborted = true;

						setTimeout( function() {
							xhr.onabort();
						}, 0 );
					}
				};

			return xhr;
		};
	}

	function observeEvents( loader ) {
		var observer = { events: '' };

		function stdObserver( evt ) {
			var message = loader.message || '-',
				data = loader.data || '-',
				url = loader.url || '-';

			if ( data.length > 21 )
				data = data.substring( 0, 21 );


			observer.events += evt.name + '[' + loader.status + ',' + loader.fileName + ',' +
				loader.uploaded + '/' + loader.loaded + '/' + loader.total + ',' +
				message  + ',' + data + ',' + url + ']|';
		}

		loader.on( 'loading', stdObserver );
		loader.on( 'loaded', stdObserver );
		loader.on( 'uploading', stdObserver );
		loader.on( 'uploaded', stdObserver );
		loader.on( 'abort', stdObserver );
		loader.on( 'error', stdObserver );
		loader.on( 'update', stdObserver );

		observer.assert = function( expected ) {
			var events = observer.events.split( '|' );
			events.pop();

			assert.areSame( expected.length, events.length,
				'Events and expected length should be the same. Actual events:\n' + observer.events.replace( /\|/g, '\n' ) );

			for ( var i = 0; i < events.length; i++ ) {
				assert.areSame( expected[ i ], events[ i ] );
			}
		};

		return observer;
	}

	function attachListener( obj, evt, listener ) {
		listeners.push( {
			obj: obj,
			evt: evt,
			listener: listener
		} );

		obj.on( evt, listener );
	}

	// For unknown reason plugin is not loaded if the code coverage is enabled
	// and there is no editor instance.
	bender.editor = {
		config: {
			extraPlugins: 'filetools,clipboard'
		}
	};

	bender.test( {
		init: function() {
			CKEDITOR.event.implementOn( editorMock );
			CKEDITOR.plugins.get( 'filetools' ).beforeInit( editorMock );
		},

		setUp: function() {
			if ( !CKEDITOR.plugins.clipboard.isFileApiSupported ) {
				assert.ignore();
			}

			FileLoader = CKEDITOR.fileTools.fileLoader;
			resumeAfter = bender.tools.resumeAfter;
			testFile = bender.tools.getTestPngFile();
		},

		tearDown: function() {
			var data;

			window.FileReader = FileReaderBackup;
			window.XMLHttpRequest = XMLHttpRequestBackup;

			while ( data = listeners.pop() ) {
				data.obj.removeListener( data.evt, data.listener );
			}

			editorMock.lang = {};
		},

		'test constructor string, no name': function() {
			var loader = new FileLoader( editorMock, pngBase64 );

			assert.areSame( 'image.png', loader.fileName );
			assert.areSame( pngBase64, loader.data );
			assert.isObject( loader.file );
			assert.areSame( 82, loader.total );
			assert.areSame( 82, loader.loaded );
			assert.areSame( 0, loader.uploaded );
			assert.areSame( 'created', loader.status );
		},

		'test constructor string, no name, default file name provided': function() {
			var loader = new FileLoader( editorMockDefaultFileName, pngBase64 );

			assert.areSame( editorMockDefaultFileName.config.fileTools_defaultFileName + '.png', loader.fileName );
			assert.areSame( pngBase64, loader.data );
			assert.isObject( loader.file );
			assert.areSame( 82, loader.total );
			assert.areSame( 82, loader.loaded );
			assert.areSame( 0, loader.uploaded );
			assert.areSame( 'created', loader.status );
		},

		'test constructor string, filename': function() {
			var loader = new FileLoader( editorMock, pngBase64, 'foo' );

			assert.areSame( 'foo', loader.fileName );
			assert.areSame( pngBase64, loader.data );
			assert.isObject( loader.file );
			assert.areSame( 82, loader.total );
			assert.areSame( 82, loader.loaded );
			assert.areSame( 0, loader.uploaded );
			assert.areSame( 'created', loader.status );
		},

		'test constructor file, no name': function() {
			var loader = new FileLoader( editorMock, testFile );

			assert.areSame( 'name.png', loader.fileName );
			assert.isNull( loader.data );
			assert.isObject( loader.file );
			assert.areSame( 82, loader.total );
			assert.areSame( 0, loader.loaded );
			assert.areSame( 0, loader.uploaded );
			assert.areSame( 'created', loader.status );
		},

		'test constructor file, filename': function() {
			var loader = new FileLoader( editorMock, testFile, 'bar' );

			assert.areSame( 'bar', loader.fileName );
			assert.isNull( loader.data );
			assert.isObject( loader.file );
			assert.areSame( 82, loader.total );
			assert.areSame( 0, loader.loaded );
			assert.areSame( 0, loader.uploaded );
			assert.areSame( 'created', loader.status );
		},

		'test constructor file, no filename in file': function() {
			var testFileWithoutName = bender.tools.getTestPngFile();
			testFileWithoutName.name = undefined;

			var loader = new FileLoader( editorMock, testFileWithoutName );

			assert.areSame( 'image.png', loader.fileName );
			assert.isNull( loader.data );
			assert.isObject( loader.file );
			assert.areSame( 82, loader.total );
			assert.areSame( 0, loader.loaded );
			assert.areSame( 0, loader.uploaded );
			assert.areSame( 'created', loader.status );
		},

		'test constructor file, no filename in file, default file name provided': function() {
			var testFileWithoutName = bender.tools.getTestPngFile();
			testFileWithoutName.name = undefined;

			var loader = new FileLoader( editorMockDefaultFileName, testFileWithoutName );

			assert.areSame( editorMockDefaultFileName.config.fileTools_defaultFileName + '.png', loader.fileName );
			assert.isNull( loader.data );
			assert.isObject( loader.file );
			assert.areSame( 82, loader.total );
			assert.areSame( 0, loader.loaded );
			assert.areSame( 0, loader.uploaded );
			assert.areSame( 'created', loader.status );
		},

		'test load': function() {
			var loader = new FileLoader( editorMock, testFile ),
				observer = observeEvents( loader );

			createFileReaderMock( [ 'progress', 'load' ] );

			resumeAfter( loader, 'loaded', function() {
				observer.assert( [
					'loading[loading,name.png,0/0/82,-,-,-]',
					'update[loading,name.png,0/0/82,-,-,-]',
					'update[loading,name.png,0/41/82,-,-,-]',
					'loaded[loaded,name.png,0/82/82,-,result,-]',
					'update[loaded,name.png,0/82/82,-,result,-]' ] );
			}, 3 );

			loader.load();

			wait();
		},

		'test upload': function() {
			var loader = new FileLoader( editorMock, pngBase64, 'name.png' ),
				observer = observeEvents( loader );

			createXMLHttpRequestMock( [ 'progress', 'load' ] );

			resumeAfter( loader, 'uploaded', function() {
				observer.assert( [
					'uploading[uploading,name.png,0/82/82,-,data:image/png;base64,-]',
					'update[uploading,name.png,0/82/82,-,data:image/png;base64,-]',
					'update[uploading,name.png,41/82/82,-,data:image/png;base64,-]',
					'uploaded[uploaded,name2.png,82/82/82,-,data:image/png;base64,http://url/name2.png]',
					'update[uploaded,name2.png,82/82/82,-,data:image/png;base64,http://url/name2.png]' ] );
			}, 3 );

			loader.upload( 'http:\/\/url\/' );

			assert.areSame( 'http:\/\/url\/', loader.uploadUrl );

			wait();
		},

		'test upload response not encoded (#13030)': function() {
			var loader = new FileLoader( editorMock, pngBase64, 'na me.png' ),
				observer = observeEvents( loader );

			createXMLHttpRequestMock( [ 'progress', 'load' ], {
				responseText: '{"fileName":"na me2.png","uploaded":1,"url":"http:\/\/url\/na me2.png"}'
			} );

			resumeAfter( loader, 'uploaded', function() {
				observer.assert( [
					'uploading[uploading,na me.png,0/82/82,-,data:image/png;base64,-]',
					'update[uploading,na me.png,0/82/82,-,data:image/png;base64,-]',
					'update[uploading,na me.png,41/82/82,-,data:image/png;base64,-]',
					'uploaded[uploaded,na me2.png,82/82/82,-,data:image/png;base64,http://url/na me2.png]',
					'update[uploaded,na me2.png,82/82/82,-,data:image/png;base64,http://url/na me2.png]' ] );
			}, 3 );

			loader.upload( 'http:\/\/url\/' );

			assert.areSame( 'http:\/\/url\/', loader.uploadUrl );

			wait();
		},

		'test loadAndUpload': function() {
			var loader = new FileLoader( editorMock, testFile ),
				observer = observeEvents( loader );

			createFileReaderMock( [ 'progress', 'load' ] );
			createXMLHttpRequestMock( [ 'progress', 'load' ] );

			resumeAfter( loader, 'uploaded', function() {
				observer.assert( [
					'loading[loading,name.png,0/0/82,-,-,-]',
					'update[loading,name.png,0/0/82,-,-,-]',
					'update[loading,name.png,0/41/82,-,-,-]',
					'uploading[uploading,name.png,0/82/82,-,result,-]',
					'update[uploading,name.png,0/82/82,-,result,-]',
					'update[uploading,name.png,41/82/82,-,result,-]',
					'uploaded[uploaded,name2.png,82/82/82,-,result,http://url/name2.png]',
					'update[uploaded,name2.png,82/82/82,-,result,http://url/name2.png]' ] );
			} );

			loader.loadAndUpload( 'http:\/\/url\/' );

			wait();
		},

		'test abort on create': function() {
			var loader = new FileLoader( editorMock, testFile ),
				observer = observeEvents( loader );

			resumeAfter( loader, 'abort', function() {
				observer.assert( [
					'abort[abort,name.png,0/0/82,-,-,-]',
					'update[abort,name.png,0/0/82,-,-,-]' ] );
			} );

			loader.abort();

			wait();
		},

		'test abort on loading': function() {
			var loader = new FileLoader( editorMock, testFile ),
				observer = observeEvents( loader ),
				abort = function() {
					loader.abort();
				};

			createFileReaderMock( [ abort ] );

			resumeAfter( loader, 'abort', function() {
				observer.assert( [
					'loading[loading,name.png,0/0/82,-,-,-]',
					'update[loading,name.png,0/0/82,-,-,-]',
					'abort[abort,name.png,0/0/82,-,-,-]',
					'update[abort,name.png,0/0/82,-,-,-]' ] );
			} );

			loader.loadAndUpload( 'http:\/\/url\/' );

			wait();
		},

		'test abort on loading2': function() {
			var loader = new FileLoader( editorMock, testFile ),
				observer = observeEvents( loader ),
				abort = function() {
					loader.abort();
				};

			createFileReaderMock( [ 'progress', abort ] );

			resumeAfter( loader, 'abort', function() {
				observer.assert( [
					'loading[loading,name.png,0/0/82,-,-,-]',
					'update[loading,name.png,0/0/82,-,-,-]',
					'update[loading,name.png,0/41/82,-,-,-]',
					'abort[abort,name.png,0/41/82,-,-,-]',
					'update[abort,name.png,0/41/82,-,-,-]' ] );
			} );

			loader.loadAndUpload( 'http:\/\/url\/' );

			wait();
		},

		'test abort on loaded': function() {
			var loader = new FileLoader( editorMock, testFile ),
				observer = observeEvents( loader ),
				abort = function() {
					loader.abort();
				};

			createFileReaderMock( [ 'progress', 'load', abort ] );

			resumeAfter( loader, 'loaded', function() {
				observer.assert( [
					'loading[loading,name.png,0/0/82,-,-,-]',
					'update[loading,name.png,0/0/82,-,-,-]',
					'update[loading,name.png,0/41/82,-,-,-]',
					'loaded[loaded,name.png,0/82/82,-,result,-]',
					'update[loaded,name.png,0/82/82,-,result,-]' ] );
			} );

			loader.load();

			wait();
		},

		'test abort on uploading': function() {
			var loader = new FileLoader( editorMock, testFile ),
				observer = observeEvents( loader ),
				abort = function() {
					loader.abort();
				};

			createFileReaderMock( [ 'progress', 'load' ] );
			createXMLHttpRequestMock( [ abort ] );

			resumeAfter( loader, 'abort', function() {
				observer.assert( [
					'loading[loading,name.png,0/0/82,-,-,-]',
					'update[loading,name.png,0/0/82,-,-,-]',
					'update[loading,name.png,0/41/82,-,-,-]',
					'uploading[uploading,name.png,0/82/82,-,result,-]',
					'update[uploading,name.png,0/82/82,-,result,-]',
					'abort[abort,name.png,0/82/82,-,result,-]',
					'update[abort,name.png,0/82/82,-,result,-]' ] );
			} );

			loader.loadAndUpload( 'http:\/\/url\/' );

			wait();
		},

		'test abort on uploading 2': function() {
			var loader = new FileLoader( editorMock, testFile ),
				observer = observeEvents( loader ),
				abort = function() {
					loader.abort();
				};

			createFileReaderMock( [ 'progress', 'load' ] );
			createXMLHttpRequestMock( [ 'progress', abort ] );

			resumeAfter( loader, 'abort', function() {
				observer.assert( [
					'loading[loading,name.png,0/0/82,-,-,-]',
					'update[loading,name.png,0/0/82,-,-,-]',
					'update[loading,name.png,0/41/82,-,-,-]',
					'uploading[uploading,name.png,0/82/82,-,result,-]',
					'update[uploading,name.png,0/82/82,-,result,-]',
					'update[uploading,name.png,41/82/82,-,result,-]',
					'abort[abort,name.png,41/82/82,-,result,-]',
					'update[abort,name.png,41/82/82,-,result,-]' ] );
			} );

			loader.loadAndUpload( 'http:\/\/url\/' );

			wait();
		},

		'test abort on uploaded': function() {
			var loader = new FileLoader( editorMock, testFile ),
				observer = observeEvents( loader ),
				abort = function() {
					loader.abort();
				};

			createFileReaderMock( [ 'progress', 'load' ] );
			createXMLHttpRequestMock( [ 'progress', 'load', abort ] );

			resumeAfter( loader, 'uploaded', function() {
				observer.assert( [
					'loading[loading,name.png,0/0/82,-,-,-]',
					'update[loading,name.png,0/0/82,-,-,-]',
					'update[loading,name.png,0/41/82,-,-,-]',
					'uploading[uploading,name.png,0/82/82,-,result,-]',
					'update[uploading,name.png,0/82/82,-,result,-]',
					'update[uploading,name.png,41/82/82,-,result,-]',
					'uploaded[uploaded,name2.png,82/82/82,-,result,http://url/name2.png]',
					'update[uploaded,name2.png,82/82/82,-,result,http://url/name2.png]' ] );
			} );

			loader.loadAndUpload( 'http:\/\/url\/' );

			wait();
		},

		'test abort on error': function() {
			editorMock.lang = { filetools: { loadError: 'errorMsg' } };

			var loader = new FileLoader( editorMock, testFile ),
				observer = observeEvents( loader ),
				abort = function() {
					loader.abort();
				};

			createFileReaderMock( [ 'progress', 'error', abort ] );

			resumeAfter( loader, 'error', function() {
				observer.assert( [
					'loading[loading,name.png,0/0/82,-,-,-]',
					'update[loading,name.png,0/0/82,-,-,-]',
					'update[loading,name.png,0/41/82,-,-,-]',
					'error[error,name.png,0/41/82,errorMsg,-,-]',
					'update[error,name.png,0/41/82,errorMsg,-,-]' ] );
			} );

			loader.load();

			wait();
		},

		'test abort on abort (abort twice)': function() {
			editorMock.lang = { filetools: { loadError: 'errorMsg' } };

			var loader = new FileLoader( editorMock, testFile ),
				observer = observeEvents( loader ),
				abort = function() {
					loader.abort();
				};

			createFileReaderMock( [ 'progress', abort, abort ] );

			resumeAfter( loader, 'abort', function() {
				observer.assert( [
					'loading[loading,name.png,0/0/82,-,-,-]',
					'update[loading,name.png,0/0/82,-,-,-]',
					'update[loading,name.png,0/41/82,-,-,-]',
					'abort[abort,name.png,0/41/82,-,-,-]',
					'update[abort,name.png,0/41/82,-,-,-]' ] );
			} );

			loader.load();

			wait();
		},

		'test error on load': function() {
			editorMock.lang = { filetools: { loadError: 'loadError' } };

			var loader = new FileLoader( editorMock, testFile ),
				observer = observeEvents( loader );

			createFileReaderMock( [ 'progress', 'error' ] );

			resumeAfter( loader, 'error', function() {
				observer.assert( [
					'loading[loading,name.png,0/0/82,-,-,-]',
					'update[loading,name.png,0/0/82,-,-,-]',
					'update[loading,name.png,0/41/82,-,-,-]',
					'error[error,name.png,0/41/82,loadError,-,-]',
					'update[error,name.png,0/41/82,loadError,-,-]' ] );
			} );

			loader.load();

			wait();
		},

		'test error on upload': function() {
			editorMock.lang = { filetools: { networkError: 'networkError' } };

			var loader = new FileLoader( editorMock, testFile ),
				observer = observeEvents( loader );

			createFileReaderMock( [ 'progress', 'load' ] );
			createXMLHttpRequestMock( [ 'progress', 'error' ] );

			resumeAfter( loader, 'error', function() {
				observer.assert( [
					'loading[loading,name.png,0/0/82,-,-,-]',
					'update[loading,name.png,0/0/82,-,-,-]',
					'update[loading,name.png,0/41/82,-,-,-]',
					'uploading[uploading,name.png,0/82/82,-,result,-]',
					'update[uploading,name.png,0/82/82,-,result,-]',
					'update[uploading,name.png,41/82/82,-,result,-]',
					'error[error,name.png,41/82/82,networkError,result,-]',
					'update[error,name.png,41/82/82,networkError,result,-]' ] );
			} );

			loader.loadAndUpload( 'http:\/\/url\/' );

			wait();
		},

		'test error no url': function() {
			editorMock.lang = { filetools: { noUrlError: 'noUrlError' } };

			var loader = new FileLoader( editorMock, testFile ),
				observer = observeEvents( loader );

			createFileReaderMock( [ 'progress', 'load' ] );
			createXMLHttpRequestMock( [ 'progress', 'error' ] );

			resumeAfter( loader, 'error', function() {
				observer.assert( [
					'loading[loading,name.png,0/0/82,-,-,-]',
					'update[loading,name.png,0/0/82,-,-,-]',
					'update[loading,name.png,0/41/82,-,-,-]',
					'error[error,name.png,0/82/82,noUrlError,result,-]',
					'update[error,name.png,0/82/82,noUrlError,result,-]' ] );
			} );

			loader.loadAndUpload();

			wait();
		},

		'test error incorrect response': function() {
			editorMock.lang = { filetools: { responseError: 'responseError' } };

			var loader = new FileLoader( editorMock, testFile ),
				observer = observeEvents( loader );

			createXMLHttpRequestMock( [ 'progress', 'load' ], { responseText: 'incorrect' } );

			resumeAfter( loader, 'error', function() {
				observer.assert( [
					'uploading[uploading,name.png,0/0/82,-,-,-]',
					'update[uploading,name.png,0/0/82,-,-,-]',
					'update[uploading,name.png,41/0/82,-,-,-]',
					'error[error,name.png,82/0/82,responseError,-,-]',
					'update[error,name.png,82/0/82,responseError,-,-]' ] );
			} );

			loader.upload( 'http:\/\/url\/' );

			wait();
		},

		'test error in response': function() {
			editorMock.lang = { filetools: { responseError: 'responseError %1' } };

			var loader = new FileLoader( editorMock, testFile ),
				observer = observeEvents( loader );

			createXMLHttpRequestMock( [ 'progress', 'load' ],
				{ responseText: '{' +
					'"fileName":"name2.png",' +
					'"uploaded":0,' +
					'"url":"http:\/\/url\/name2.png",' +
					'"error":{' +
						'"message":"errorFromServer"' +
					'}' +
				'}' } );

			resumeAfter( loader, 'error', function() {
				observer.assert( [
					'uploading[uploading,name.png,0/0/82,-,-,-]',
					'update[uploading,name.png,0/0/82,-,-,-]',
					'update[uploading,name.png,41/0/82,-,-,-]',
					'error[error,name.png,82/0/82,errorFromServer,-,-]',
					'update[error,name.png,82/0/82,errorFromServer,-,-]' ] );
			} );

			loader.upload( 'http:\/\/url\/' );

			wait();
		},

		'test response with message': function() {
			editorMock.lang = { filetools: { responseError: 'responseError %1' } };

			var loader = new FileLoader( editorMock, testFile ),
				observer = observeEvents( loader );

			createXMLHttpRequestMock( [ 'progress', 'load' ],
				{ responseText: '{' +
					'"fileName":"name2.png",' +
					'"uploaded":1,' +
					'"url":"http:\/\/url\/name2.png",' +
					'"error":{' +
						'"message":"messageFromServer"' +
					'}' +
				'}' } );

			resumeAfter( loader, 'uploaded', function() {
				observer.assert( [
					'uploading[uploading,name.png,0/0/82,-,-,-]',
					'update[uploading,name.png,0/0/82,-,-,-]',
					'update[uploading,name.png,41/0/82,-,-,-]',
					'uploaded[uploaded,name2.png,82/0/82,messageFromServer,-,http://url/name2.png]',
					'update[uploaded,name2.png,82/0/82,messageFromServer,-,http://url/name2.png]' ] );
			} );

			loader.upload( 'http:\/\/url\/' );

			wait();
		},

		'test error 404 with message': function() {
			editorMock.lang = { filetools: { httpError404: 'httpError404' } };

			var loader = new FileLoader( editorMock, testFile ),
				observer = observeEvents( loader );

			createXMLHttpRequestMock( [ 'progress', 'load' ], { responseStatus: 404 } );

			resumeAfter( loader, 'error', function() {
				observer.assert( [
					'uploading[uploading,name.png,0/0/82,-,-,-]',
					'update[uploading,name.png,0/0/82,-,-,-]',
					'update[uploading,name.png,41/0/82,-,-,-]',
					'error[error,name.png,82/0/82,httpError404,-,-]',
					'update[error,name.png,82/0/82,httpError404,-,-]' ] );
			} );

			loader.upload( 'http:\/\/url\/' );

			wait();
		},

		'test error 404 general message': function() {
			editorMock.lang = { filetools: { httpError: 'httpError %1' } };

			var loader = new FileLoader( editorMock, testFile ),
				observer = observeEvents( loader );

			createXMLHttpRequestMock( [ 'progress', 'load' ], { responseStatus: 404 } );

			resumeAfter( loader, 'error', function() {
				observer.assert( [
					'uploading[uploading,name.png,0/0/82,-,-,-]',
					'update[uploading,name.png,0/0/82,-,-,-]',
					'update[uploading,name.png,41/0/82,-,-,-]',
					'error[error,name.png,82/0/82,httpError 404,-,-]',
					'update[error,name.png,82/0/82,httpError 404,-,-]' ] );
			} );

			loader.upload( 'http:\/\/url\/' );

			wait();
		},

		'test upload ok on status 202': function() {
			var loader = new FileLoader( editorMock, testFile ),
				observer = observeEvents( loader );

			createXMLHttpRequestMock( [ 'progress', 'load' ], { responseStatus: 202 } );

			resumeAfter( loader, 'uploaded', function() {
				observer.assert( [
					'uploading[uploading,name.png,0/0/82,-,-,-]',
					'update[uploading,name.png,0/0/82,-,-,-]',
					'update[uploading,name.png,41/0/82,-,-,-]',
					'uploaded[uploaded,name2.png,82/0/82,-,-,http://url/name2.png]',
					'update[uploaded,name2.png,82/0/82,-,-,http://url/name2.png]' ] );
			} );

			loader.upload( 'http:\/\/url\/' );

			wait();
		},

		'test update': function() {
			var loader = new FileLoader( editorMock, testFile ),
				observer = observeEvents( loader ),
				update = function() {
					loader.update();
				};

			createXMLHttpRequestMock( [ 'progress', update, 'load', update ] );

			resumeAfter( loader, 'uploaded', function() {
				// Wait for all update events.
				wait( function() {
					observer.assert( [
						'update[created,name.png,0/0/82,-,-,-]',
						'uploading[uploading,name.png,0/0/82,-,-,-]',
						'update[uploading,name.png,0/0/82,-,-,-]',
						'update[uploading,name.png,41/0/82,-,-,-]',
						'update[uploading,name.png,41/0/82,-,-,-]',
						'uploaded[uploaded,name2.png,82/0/82,-,-,http://url/name2.png]',
						'update[uploaded,name2.png,82/0/82,-,-,http://url/name2.png]',
						'update[uploaded,name2.png,82/0/82,-,-,http://url/name2.png]' ] );
				}, 5 );
			} );

			loader.update();
			loader.upload( 'http:\/\/url\/' );

			wait();
		},

		'test custom fileUploadRequest and fileUploadResponse': function() {
			editorMock.lang = { filetools: { responseError: 'err' } };

			var loader = new FileLoader( editorMock, testFile ),
				observer = observeEvents( loader ),
				sendRequestCounter = 0,
				handleResponseCounter = 0;

			attachListener( editorMock, 'fileUploadRequest', function( evt ) {
				sendRequestCounter++;

				evt.data.fileLoader.xhr.send( 'custom form' );
				evt.stop();
			} );

			attachListener( editorMock, 'fileUploadResponse', function( evt ) {
				handleResponseCounter++;

				var response = evt.data.fileLoader.xhr.responseText.split( '|' );

				evt.data.fileName = response[ 0 ];
				evt.data.url = response[ 1 ];
				evt.data.message = response[ 2 ];
				evt.stop();
			} );

			createXMLHttpRequestMock( [ 'progress', 'load' ],
				{ responseText: 'customName.png|customUrl|customMessage' } );

			resumeAfter( loader, 'uploaded', function() {
				assert.areSame( 1, sendRequestCounter, 'sendRequestCounter' );
				assert.areSame( 1, handleResponseCounter, 'handleResponseCounter' );
				assert.areSame( 'custom form', lastFormData );

				observer.assert( [
					'uploading[uploading,name.png,0/0/82,-,-,-]',
					'update[uploading,name.png,0/0/82,-,-,-]',
					'update[uploading,name.png,41/0/82,-,-,-]',
					'uploaded[uploaded,customName.png,82/0/82,customMessage,-,customUrl]',
					'update[uploaded,customName.png,82/0/82,customMessage,-,customUrl]' ] );
			} );

			loader.upload( 'http:\/\/url\/' );

			wait();
		},

		'test cancel fileUploadRequest': function() {
			editorMock.lang = { filetools: { responseError: 'err' } };

			var loader = new FileLoader( editorMock, testFile ),
				observer = observeEvents( loader );

			attachListener( editorMock, 'fileUploadRequest', function( evt ) {
				evt.cancel();
			} );

			createXMLHttpRequestMock( [ 'progress', 'load' ] );

			loader.upload( 'http:\/\/url\/' );

			observer.assert( [] );
		},


		'test cancel fileUploadResponse': function() {
			editorMock.lang = { filetools: { responseError: 'err' } };

			var loader = new FileLoader( editorMock, testFile ),
				observer = observeEvents( loader );

			attachListener( editorMock, 'fileUploadResponse', function( evt ) {
				evt.cancel();
			} );

			createXMLHttpRequestMock( [ 'progress', 'load' ] );

			resumeAfter( loader, 'error', function() {
				observer.assert( [
					'uploading[uploading,name.png,0/0/82,-,-,-]',
					'update[uploading,name.png,0/0/82,-,-,-]',
					'update[uploading,name.png,41/0/82,-,-,-]',
					'error[error,name.png,82/0/82,-,-,-]',
					'update[error,name.png,82/0/82,-,-,-]' ] );
			} );

			loader.upload( 'http:\/\/url\/' );

			wait();
		},

		'test xhr property': function() {
			var loader = new FileLoader( editorMock, testFile ),
				report = '';

			createFileReaderMock( [ 'progress', 'load' ] );
			createXMLHttpRequestMock( [ 'progress', 'load' ] );

			function listener() {
				if ( loader.xhr ) {
					report += '+';
				} else {
					report += '-';
				}
			}

			loader.on( 'loading', listener );
			loader.on( 'loaded', listener );
			loader.on( 'uploading', listener );
			loader.on( 'uploaded', listener );

			resumeAfter( loader, 'uploaded', function() {
				assert.areSame( '-++', report );
			} );

			loader.loadAndUpload( 'http:\/\/url\/' );

			wait();
		},

		'test reader property': function() {
			var loader = new FileLoader( editorMock, testFile ),
				report = '';

			createFileReaderMock( [ 'progress', 'load' ] );
			createXMLHttpRequestMock( [ 'progress', 'load' ] );

			function listener() {
				if ( loader.reader ) {
					report += '+';
				} else {
					report += '-';
				}
			}

			loader.on( 'loading', listener );
			loader.on( 'loaded', listener );
			loader.on( 'uploading', listener );
			loader.on( 'uploaded', listener );

			resumeAfter( loader, 'uploaded', function() {
				assert.areSame( '+++', report );
			} );

			loader.loadAndUpload( 'http:\/\/url\/' );

			wait();
		},

		'test isFinished created': function() {
			var loader = new FileLoader( editorMock, testFile );
			loader.status = 'created';

			assert.isFalse( loader.isFinished() );
		},

		'test isFinished loading': function() {
			var loader = new FileLoader( editorMock, testFile );
			loader.status = 'loading';

			assert.isFalse( loader.isFinished() );
		},

		'test isFinished loaded': function() {
			var loader = new FileLoader( editorMock, testFile );
			loader.status = 'loaded';

			assert.isTrue( loader.isFinished() );
		},

		'test isFinished uploading': function() {
			var loader = new FileLoader( editorMock, testFile );
			loader.status = 'uploading';

			assert.isFalse( loader.isFinished() );
		},

		'test isFinished uploaded': function() {
			var loader = new FileLoader( editorMock, testFile );
			loader.status = 'uploaded';

			assert.isTrue( loader.isFinished() );
		},

		'test isFinished error': function() {
			var loader = new FileLoader( editorMock, testFile );
			loader.status = 'error';

			assert.isTrue( loader.isFinished() );
		},

		'test isFinished abort': function() {
			var loader = new FileLoader( editorMock, testFile );
			loader.status = 'abort';

			assert.isTrue( loader.isFinished() );
		}
	} );
} )();
