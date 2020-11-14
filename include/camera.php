<div id="app_scanner">
	<div class="sidebar">
		<section class="cameras">
			<h2>Камера</h2>
			<ul>
				<li v-if="cameras.length === 0" class="empty">Камера не найдена</li>
				<li v-for="camera in cameras">
					<span v-if="camera.id == activeCameraId" :title="formatName(camera.name)" class="active">{{ formatName(camera.name) }}</span>
					<span v-if="camera.id != activeCameraId" :title="formatName(camera.name)">
						<a @click.stop="selectCamera(camera)">{{ formatName(camera.name) }}</a>
					</span>
				</li>
			</ul>
		</section>
		<section class="scans">
			<h2>Сканирование</h2>
			<ul v-if="scans.length === 0">
				<li class="empty">Нет данных</li>
			</ul>
			<transition-group name="scans" tag="ul">
				<li v-for="scan in scans" :key="scan.date" :title="scan.content">{{ scan.content }}</li>
			</transition-group>
		</section>
	</div>
	<div class="preview-container">
		<video id="preview"></video>
	</div>
</div>