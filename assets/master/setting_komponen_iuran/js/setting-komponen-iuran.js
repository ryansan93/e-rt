var ski = {
	startUp: function(){
		ski.getLists();
	}, // end - startUp

	addForm: function() {
		$.get('master/SettingKomponenIuran/addForm',{
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

				$(this).find('[data-tipe=integer],[data-tipe=angka],[data-tipe=decimal],[data-tipe=decimal3],[data-tipe=decimal4],[data-tipe=number]').each(function(){
					priceFormat( $(this) );
				});

				$(this).removeAttr('tabindex');
				$(this).find('select.iuran').select2().on('select2:select', function(e) {
					ski.hitTotal();
				});
				$(this).find('table tbody tr.data input').blur(function(e) {
					ski.hitTotal();
				});

				$(this).find("#TglBerlaku").datetimepicker({
					locale: 'id',
					format: 'DD MMM Y'
				});
			});
		},'html');
	}, // end - addForm

	viewForm: function(elm) {
		var tr = $(elm).closest('tr');

		var params = {
			'tgl_berlaku': $(tr).find('td.tgl_berlaku').attr('data-val'),
			'kode_iuran': $(tr).find('td.kode_iuran').attr('data-val'),
		};

		ski._viewForm( params );
	}, // end - viewForm

	_viewForm: function(params) {
		$.get('master/SettingKomponenIuran/viewForm',{
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

				$(this).find('[data-tipe=integer],[data-tipe=angka],[data-tipe=decimal],[data-tipe=decimal3],[data-tipe=decimal4],[data-tipe=number]').each(function(){
					priceFormat( $(this) );
				});

				$(this).removeAttr('tabindex');
			});
		},'html');
	}, // end - _viewForm

	editForm: function(elm) {
		var modal = $(elm).closest('.modal');
		$(modal).modal('hide');

		var params = {
			'tgl_berlaku': $('label.tglBerlaku').attr('data-val'),
			'kode_iuran': $('label.kodeIuran').attr('data-val'),
		};

		$.get('master/SettingKomponenIuran/editForm',{
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

				$(this).find('[data-tipe=integer],[data-tipe=angka],[data-tipe=decimal],[data-tipe=decimal3],[data-tipe=decimal4],[data-tipe=number]').each(function(){
					priceFormat( $(this) );
				});

				$(this).removeAttr('tabindex');
				$(this).find('select.iuran').select2().on('select2:select', function(e) {
					ski.hitTotal();
				});
				$(this).find('table tbody tr.data input').blur(function(e) {
					ski.hitTotal();
				});

				$(this).find("#TglBerlaku").datetimepicker({
					locale: 'id',
					format: 'DD MMM Y'
				});

				var tgl = $(this).find("#TglBerlaku input").attr('data-tgl');
				$("#TglBerlaku").data('DateTimePicker').date( moment(new Date((tgl))) );
			});
		},'html');
	}, // end - editForm

	batal: function(elm) {
		var modal = $(elm).closest('.modal');

		$(modal).modal('hide');

		var params = {
			'tgl_berlaku': $(elm).attr('data-tgl'),
			'kode_iuran': $(elm).attr('data-ki'),
		};

		console.log( params );

		ski._viewForm( params );
	}, // end - batal

	getLists : function(){
		var dcontent = $('table.tblRiwayat tbody');

		if ($.fn.dataTable.isDataTable('.tblRiwayat')) {
			$('.tblRiwayat').DataTable().destroy();
		}

		$.ajax({
			url : 'master/SettingKomponenIuran/getLists',
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

	hitTotal: function() {
		var iuran = $('select.iuran').find('option:selected').attr('data-nominal');
		
		var tot_nominal = 0;
		$.map( $('table').find('tbody tr.data input'), function(ipt) {
			var nominal = numeral.unformat( $(ipt).val() );

			tot_nominal += nominal;
		});

		$('table').find('tfoot td.total b').html( numeral.formatInt( tot_nominal ) );
	}, // end - hitTotal

	cekData: function (elm) {
		var err = 0;
		var err_komponen_iuran = 1;
		var err_nominal_iuran = 1;
		$.map( $('input[data-required=1]'), function(input){
			if ( empty($(input).val()) ) {
				$(input).parent().addClass('has-error');
				err++;
			} else {
				$(input).parent().removeClass('has-error');
			};
		});

		if ( $('table').find('tbody tr.data').length > 0 ) {
			err_komponen_iuran = 0;
		}

		var iuran = $('select.iuran').find('option:selected').attr('data-nominal');
		var tot_nominal = numeral.unformat( $('table').find('tfoot td.total b').text() );

		if ( tot_nominal == iuran ) {
			err_nominal_iuran = 0;
		}

		if ( err_komponen_iuran > 0 ) {
			bootbox.alert('Komponen iuran tidak ditemukan.');
		} else {
			if ( err_nominal_iuran > 0 ) {
				bootbox.alert('Nominal iuran dan yang di setting tidak sama, harap cek kembali data yang anda masukkan.');
			} else {
				if ( err > 0 ) {
					bootbox.alert('Harap lengkapi data terlebih dahulu.');
				} else {
					bootbox.confirm('Apakah anda yakin ingin menyimpan data ?', function(result){
						if (result) {
							var data = {
								'tgl_berlaku': dateSQL( $('#TglBerlaku').data('DateTimePicker').date() ),
								'kode_iuran': $('select.iuran').select2().val(),
								'tgl_berlaku_old': $(elm).attr('data-tgl'),
								'kode_iuran_old': $(elm).attr('data-ki')
							};

							$.ajax({
								url : 'master/SettingKomponenIuran/cekData',
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
											ski.save();
										}

										if ( $(elm).attr('data-jenis') == 'edit' ) {
											ski.edit( $(elm) );
										}
									} else {
										bootbox.alert(data.message);
									}
								}
							});
						}
					});
				}
			}
		}
	}, // end - cekData

	save: function () {
		var modal = $('.modal');

		var detail = $.map( $(modal).find('table tbody tr.data'), function(tr) {
			var _data = {
				'kode_komponen_iuran': $(tr).find('td.kode').attr('data-val'),
				'nominal': numeral.unformat( $(tr).find('input.nominal').val() )
			};

			return _data;
		});

		var data = {
			'tgl_berlaku': dateSQL( $('#TglBerlaku').data('DateTimePicker').date() ),
			'kode_iuran': $('select.iuran').select2().val(),
			'detail': detail
		};

		$.ajax({
			url : 'master/SettingKomponenIuran/save',
			dataType: 'json',
			type: 'post',
			data: {
				'params' : data
			},
			beforeSend : function(){
				showLoading('Proses simpan data . . .');
			},
			success : function(data){
				hideLoading();
				if ( data.status == 1 ) {
					bootbox.alert(data.message, function(){
						ski.getLists();
						bootbox.hideAll();
					});
				} else {
					bootbox.alert(data.message);
				}
			}
		});
	}, // end - save

	edit: function (elm) {
		var modal = $('.modal');

		var detail = $.map( $(modal).find('table tbody tr.data'), function(tr) {
			var _data = {
				'kode_komponen_iuran': $(tr).find('td.kode').attr('data-val'),
				'nominal': numeral.unformat( $(tr).find('input.nominal').val() )
			};

			return _data;
		});

		var data = {
			'tgl_berlaku': dateSQL( $('#TglBerlaku').data('DateTimePicker').date() ),
			'kode_iuran': $('select.iuran').select2().val(),
			'tgl_berlaku_old': $(elm).attr('data-tgl'),
			'kode_iuran_old': $(elm).attr('data-ki'),
			'detail': detail
		};

		$.ajax({
			url : 'master/SettingKomponenIuran/edit',
			dataType: 'json',
			type: 'post',
			data: {
				'params' : data
			},
			beforeSend : function(){
				showLoading('Proses simpan data . . .');
			},
			success : function(data){
				hideLoading();
				if ( data.status == 1 ) {
					bootbox.alert(data.message, function(){
						ski.getLists();
						bootbox.hideAll();
					});
				} else {
					bootbox.alert(data.message);
				}
			}
		});
	}, // end - edit

	delete: function(elm) {
		bootbox.confirm('Apakah anda yakin ingin menghapus data ?', function(result){
			if ( result ) {
				var params = {
					'tgl_berlaku': $(elm).attr('data-tgl'),
					'kode_iuran': $(elm).attr('data-ki')
				};

				$.ajax({
					url : 'master/SettingKomponenIuran/delete',
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
								ski.getLists();
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

ski.startUp();