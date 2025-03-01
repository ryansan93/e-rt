var ki = {
	startUp: function(){
		ki.getLists();
	}, // end - startUp

	addForm: function() {
		$.get('master/KomponenIuran/addForm',{
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
			});
		},'html');
	}, // end - addForm

	editForm: function(elm) {
		var params = {
			'kode': $(elm).attr('data-kode')
		};

		$.get('master/KomponenIuran/editForm',{
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
			});
		},'html');
	}, // end - editForm

	getLists : function(){
		var dcontent = $('table.tblRiwayat tbody');

		if ($.fn.dataTable.isDataTable('.tblRiwayat')) {
			$('.tblRiwayat').DataTable().destroy();
		}

		$.ajax({
			url : 'master/KomponenIuran/getLists',
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

	save: function () {
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
						'nama' : $('input.keterangan').val()
					};

					$.ajax({
						url : 'master/KomponenIuran/save',
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
									ki.getLists();
									bootbox.hideAll();
								});
							} else {
								bootbox.alert(data.message);
							}
						}
					});
				};
			});
		};
	}, // end - save

	edit: function () {
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
				if ( result ) {
					var data = {
						'kode' : $('input.kode').val(),
						'nama' : $('input.keterangan').val()
					};

					$.ajax({
						url : 'master/KomponenIuran/edit',
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
									ki.getLists();
									bootbox.hideAll();
								});
							} else {
								bootbox.alert(data.message);
							}
						}
					});
				};
			});
		};
	}, // end - edit

	delete: function(elm) {
		var params = {
			'kode': $(elm).attr('data-kode')
		};

		bootbox.confirm('Apakah anda yakin ingin menghapus data ?', function(result){
			if ( result ) {
				$.ajax({
					url : 'master/KomponenIuran/delete',
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
								ki.getLists();
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

ki.startUp();