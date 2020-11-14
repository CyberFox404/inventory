var app = new Vue({
	el: '#app_scanner',
	data: {
		scanner: null,
		activeCameraId: null,
		cameras: [],
		scans: []
	},
	mounted: function () {
		var self = this;
		self.scanner = new Instascan.Scanner({ video: document.getElementById('preview'), mirror: false,  scanPeriod: 5 });
		
		self.scanner.addListener('scan', function (content)
		{
			self.scans.unshift({ date: +(Date.now()), content: content });
			if((/(rhpn)/i.test(content)) || (/(rhin)/i.test(content)))
			{
				var res = content.replace('rhpn=', '')
				$('#col_1_filter').val(res);
				$('#table_id').DataTable().column( 1 ).search(
					$('#col_1_filter').val()
				).draw();
				$('#modal_scanner').modal('hide');
				//self.scanner.stop();
			}
		});
		
		Instascan.Camera.getCameras().then(function (cameras)
		{
			self.cameras = cameras;
			if (cameras.length > 0) {
				self.activeCameraId = cameras[0].id;
				//self.scanner.start(cameras[0]);
			} else {
				console.error('Камера не найдена.');
			}
		}).catch(function (e) {
			console.error(e);
		});
	},
	methods: 
	{
		formatName: function (name)
		{
			return name || '(нд)';
		},
		selectCamera: function (camera)
		{
			this.activeCameraId = camera.id;
			this.scanner.start(camera);
		}
	}
});