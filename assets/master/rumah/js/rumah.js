var r = {
	startUp: function(){
		r.getLists();
	}, // end - startUp

	addForm: function() {
		$.get('master/Rumah/addForm',{
			},function(data){
			var _options = {
				className : 'veryWidth',
				message : data,
				size : 'large',
			};
			bootbox.dialog(_options).bind('shown.bs.modal', function(){
				var modal_body = $(this).find('.modal-body');
				var table = $(modal_body).find('table');
				var tbody = $(table).find('tbody');
				if ( $(tbody).find('.modal-body tr').length <= 1 ) {
			        $(this).find('tr #btn-remove').addClass('hide');
			    };

				$('[data-tipe=integer],[data-tipe=angka],[data-tipe=decimal],[data-tipe=decimal3],[data-tipe=decimal4],[data-tipe=number]').each(function(){
					priceFormat( $(this) );
				});

				$(this).removeAttr('tabindex');
				$(this).find('select.iuran').select2();
			});
		},'html');
	}, // end - addForm

	editForm: function(elm) {
		var params = {
			'kode': $(elm).attr('data-kode')
		};

		$.get('master/Rumah/editForm',{
			'params': params
			},function(data){
			var _options = {
				className : 'veryWidth',
				message : data,
				size : 'large',
			};
			bootbox.dialog(_options).bind('shown.bs.modal', function(){
				var modal_body = $(this).find('.modal-body');
				var table = $(modal_body).find('table');
				var tbody = $(table).find('tbody');
				if ( $(tbody).find('.modal-body tr').length <= 1 ) {
					$(this).find('tr #btn-remove').addClass('hide');
				};

				$('[data-tipe=integer],[data-tipe=angka],[data-tipe=decimal],[data-tipe=decimal3],[data-tipe=decimal4],[data-tipe=number]').each(function(){
					priceFormat( $(this) );
				});

				$(this).removeAttr('tabindex');
				$(this).find('select.iuran').select2();
			});
		},'html');
	}, // end - editForm

	getLists : function(){
		var dcontent = $('table.tblRiwayat tbody');

		if ($.fn.dataTable.isDataTable('.tblRiwayat')) {
			$('.tblRiwayat').DataTable().destroy();
		}

		$.ajax({
			url : 'master/Rumah/getLists',
			data : {},
			dataType : 'HTML',
			type : 'GET',
			beforeSend : function(){ App.showLoaderInContent( dcontent ); },
			success : function(html){
				App.hideLoaderInContent(dcontent, html);

				if ( $('.tblRiwayat').find('tbody tr.data').length > 0 ) {
					$('.tblRiwayat').DataTable();
				}
			}
		});
	}, // end - getLists

	cekData: function (elm) {
		var err = 0;
		$.map( $('input[data-required=1]'), function(input){
			if ( empty($(input).val()) ) {
				$(input).parent().addClass('has-error');
				err++;
			} else {
				$(input).parent().removeClass('has-error');
			};
		});

		if ( err > 0 ) {
			bootbox.alert('Harap lengkapi data terlebih dahulu.');
		} else {
			bootbox.confirm('Apakah anda yakin ingin menyimpan data ?', function(result){
				if (result) {
					var data = {
						'kode': $(elm).attr('data-kode'),
						'no_rumah': $('input.no_rumah').val()
					};

					$.ajax({
						url : 'master/Rumah/cekData',
						dataType: 'json',
						type: 'post',
						data: {
							'params' : data
						},
						beforeSend : function(){
							showLoading('Proses cek data . . .');
						},
						success : function(data){
							hideLoading();
							if ( data.status == 1 ) {
								if ( $(elm).attr('data-jenis') == 'save' ) {
									r.save();
								}

								if ( $(elm).attr('data-jenis') == 'edit' ) {
									r.edit( $(elm) );
								}
							} else {
								bootbox.alert(data.message);
							}
						}
					});
				}
			});
		}
	}, // end - cekData

	save: function () {
		var data = {
			'no_rumah' : $('input.no_rumah').val().toUpperCase(),
			'pemilik' : $('input.pemilik').val().toUpperCase(),
			'kode_iuran' : $('select.iuran').select2().val(),
		};

		$.ajax({
			url : 'master/Rumah/save',
			dataType: 'json',
			type: 'post',
			data: {
				'params' : data
			},
			beforeSend : function(){
				showLoading();
			},
			success : function(data){
				hideLoading();
				if ( data.status == 1 ) {
					bootbox.alert(data.message, function(){
						r.getLists();
						bootbox.hideAll();
					});
				} else {
					bootbox.alert(data.message);
				}
			}
		});
	}, // end - save

	edit: function (elm) {
		var data = {
			'kode': $(elm).attr('data-kode'),
			'no_rumah' : $('input.no_rumah').val().toUpperCase(),
			'pemilik' : $('input.pemilik').val().toUpperCase(),
			'kode_iuran' : $('select.iuran').select2().val(),
		};

		$.ajax({
			url : 'master/Rumah/edit',
			dataType: 'json',
			type: 'post',
			data: {
				'params' : data
			},
			beforeSend : function(){
				showLoading();
			},
			success : function(data){
				hideLoading();
				if ( data.status == 1 ) {
					bootbox.alert(data.message, function(){
						r.getLists();
						bootbox.hideAll();
					});
				} else {
					bootbox.alert(data.message);
				}
			}
		});
	}, // end - edit

	delete: function(elm) {
		var params = {
			'kode': $(elm).attr('data-kode')
		};

		bootbox.confirm('Apakah anda yakin ingin menghapus data ?', function(result){
			if ( result ) {
				$.ajax({
					url : 'master/Rumah/delete',
					dataType: 'json',
					type: 'post',
					data: {
						'params' : params
					},
					beforeSend : function(){
						showLoading();
					},
					success : function(data){
						hideLoading();
						if ( data.status == 1 ) {
							bootbox.alert(data.message, function(){
								r.getLists();
								bootbox.hideAll();
							});
						} else {
							bootbox.alert(data.message);
						}
					}
				});
			};
		});

	}, // end - delete
};

r.startUp();