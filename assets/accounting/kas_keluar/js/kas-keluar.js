var kk = {
	startUp: function(){
		kk.getLists();
	}, // end - startUp

	setBindSHA1 : function(){
        $('input:file').off('change.sha1');
        $('input:file').on('change.sha1',function(){
            var elm = $(this);
            var file = elm.get(0).files[0];
            elm.attr('data-sha1', '');
            sha1_file(file).then(function (sha1) {
                elm.attr('data-sha1', sha1);
            });
        });
    }, // end - setBindSHA1

    showNameFile : function(elm, isLable = 1) {
        var _label = $(elm).closest('label');
        var _a = _label.next('a[name=dokumen]');
        _a.removeClass('hide');
        var _allowtypes = $(elm).data('allowtypes').split('|');
        var _dataName = $(elm).data('name');
        // var _allowtypes = ['xlsx'];
        var _type = $(elm).get(0).files[0]['name'].split('.').pop();
        var _namafile = $(elm).val();
        var _temp_url = URL.createObjectURL($(elm).get(0).files[0]);
        _namafile = _namafile.substring(_namafile.lastIndexOf("\\") + 1, _namafile.length);

        if (in_array(_type, _allowtypes)) {
            if (isLable == 1) {
                if (_a.length) {
                    _a.attr('title', _namafile);
                    _a.attr('href', _temp_url);
                    if ( _dataName == 'name' ) {
                        $(_a).text( _namafile );  
                    }
                }
            } else if (isLable == 0) {
                $(elm).closest('label').attr('title', _namafile);
            }
            $(elm).attr('data-filename', _namafile);
        } else {
            $(elm).val('');
            $(elm).closest('label').attr('title', '');
            $(elm).attr('data-filename', '');
            _a.addClass('hide');
            bootbox.alert('Format file tidak sesuai. Mohon attach ulang.');
        }
    }, // end - showNameFile

	addForm: function() {
		$.get('accounting/KasKeluar/addForm',{
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

				$(this).find("#TglKeluar").datetimepicker({
					locale: 'id',
					format: 'DD MMM Y'
				});

				kk.setBindSHA1();
			});
		},'html');
	}, // end - addForm

	editForm: function(elm) {
		var params = {
			'kode': $(elm).attr('data-kode')
		};

		$.get('accounting/KasKeluar/editForm',{
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

				$(this).find("#TglKeluar").datetimepicker({
					locale: 'id',
					format: 'DD MMM Y'
				});

				var tgl = $(this).find("#TglKeluar input").attr('data-tgl');
				$("#TglKeluar").data('DateTimePicker').date( moment(new Date((tgl))) );

				kk.setBindSHA1();
			});
		},'html');
	}, // end - editForm

	getLists : function(){
		var dcontent = $('table.tblRiwayat tbody');

		if ($.fn.dataTable.isDataTable('.tblRiwayat')) {
			$('.tblRiwayat').DataTable().destroy();
		}

		$.ajax({
			url : 'accounting/KasKeluar/getLists',
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
					if ( $(elm).attr('data-jenis') == 'save' ) {
						kk.save();
					}

					if ( $(elm).attr('data-jenis') == 'edit' ) {
						kk.edit( $(elm) );
					}
				}
			});
		}
	}, // end - cekData

	save: function () {
		var file_tmp = $('.file_lampiran').get(0).files[0];
		var data = {
			'tanggal': dateSQL( $('#TglKeluar').data('DateTimePicker').date() ),
			'no_bukti' : $('input.no_bukti').val().toUpperCase(),
			'nominal' : numeral.unformat( $('input.nominal').val() ),
			'keterangan' : $('textarea.keterangan').val().toUpperCase(),
		};
            
		var formData = new FormData();
		formData.append('file', file_tmp);
		formData.append('data', JSON.stringify(data));

		$.ajax({
			url: 'accounting/KasKeluar/save',
			dataType: 'json',
			type: 'post',
			async:false,
			processData: false,
			contentType: false,
			data: formData,
			beforeSend: function() {
				showLoading();
			},
			success: function(data) {
				hideLoading();
				if ( data.status == 1 ) {
					bootbox.alert(data.message, function() {
						kk.getLists();
						bootbox.hideAll();
					});
				} else {
					bootbox.alert(data.message);
				};
			},
		});
	}, // end - save

	edit: function (elm) {
		var file_tmp = $('.file_lampiran').get(0).files[0];
		var data = {
			'kode': $(elm).attr('data-kode'),
			'tanggal': dateSQL( $('#TglKeluar').data('DateTimePicker').date() ),
			'no_bukti' : $('input.no_bukti').val().toUpperCase(),
			'nominal' : numeral.unformat( $('input.nominal').val() ),
			'keterangan' : $('textarea.keterangan').val().toUpperCase(),
		};
            
		var formData = new FormData();
		formData.append('file', file_tmp);
		formData.append('data', JSON.stringify(data));

		$.ajax({
			url: 'accounting/KasKeluar/edit',
			dataType: 'json',
			type: 'post',
			async:false,
			processData: false,
			contentType: false,
			data: formData,
			beforeSend: function() {
				showLoading();
			},
			success: function(data) {
				hideLoading();
				if ( data.status == 1 ) {
					bootbox.alert(data.message, function() {
						kk.getLists();
						bootbox.hideAll();
					});
				} else {
					bootbox.alert(data.message);
				};
			},
		});
	}, // end - edit

	delete: function(elm) {
		var params = {
			'kode': $(elm).attr('data-kode')
		};

		bootbox.confirm('Apakah anda yakin ingin menghapus data ?', function(result){
			if ( result ) {
				$.ajax({
					url : 'accounting/KasKeluar/delete',
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
								kk.getLists();
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

kk.startUp();