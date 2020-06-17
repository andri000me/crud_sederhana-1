<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Crud Sederhana</title>
	<link rel="stylesheet" href="<?= base_url('assets/dist/css/bootstrap.min.css') ?>">
</head>

<body>
	<nav class="navbar navbar-dark bg-dark">
		<span class="navbar-brand mb-0 h1 mx-auto">Crud Sederhana</span>
	</nav>

	<div class="container mt-5">
		<div class="card">
			<?php
			if ($this->session->flashdata('pesan')) :
			?>
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<?= $this->session->flashdata('pesan') ?>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<?php endif; ?>
			<?php
			if (validation_errors()) :
			?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<?= validation_errors() ?>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<?php endif; ?>
			<div class="card-header d-flex justify-content-between align-items-center">
				<h5>Data Produk</h5>
				<button class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">Tambah Produk</button>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Produk</th>
								<th>Harga</th>
								<th>Jumlah</th>
								<th width="400">Keterangan</th>
								<th width="200">Option</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;
							foreach ($products as $product) :
							?>
								<tr>
									<td><?= $no ?></td>
									<td><?= $product->nama_produk ?></td>
									<td><?= number_format($product->harga, 0, ',', '.') ?></td>
									<td><?= $product->jumlah ?></td>
									<td><?= $product->keterangan ?></td>
									<td>
										<button class="btn btn-success" data-toggle="modal" data-target="#ubahModal_<?= $product->id ?>">Ubah</button>
										<a href="<?= base_url('home/hapus/' . $product->id) ?>" onclick="confirm('Apakah anda yakin ingin menghapus data ini ?')" class="btn btn-danger">Hapus</a>
									</td>
								</tr>
							<?php $no++;
							endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="tambahModalLabel">Tambah Produk</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?= base_url('home/tambah') ?>" method="POST">
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-6 col-12">
								<div class="form-group">
									<label>Nama Produk</label>
									<input type="text" name="nama" class="form-control" id="">
								</div>
								<div class="form-group">
									<label>Harga</label>
									<input type="number" name="harga" class="form-control" id="">
								</div>
								<div class="form-group">
									<label>Jumlah</label>
									<input type="number" name="jumlah" class="form-control" id="">
								</div>
							</div>
							<div class="col-lg-6 col-12">
								<div class="form-group">
									<label>Keterangan</label>
									<textarea name="keterangan" class="form-control" id="" cols="30" rows="10"></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php foreach ($products as $product) : ?>
		<div class="modal fade" id="ubahModal_<?= $product->id ?>" tabindex="-1" role="dialog" aria-labelledby="ubahModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="ubahModalLabel">Ubah Produk</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="<?= base_url('home/ubah') ?>" method="POST">
						<div class="modal-body">
							<div class="row">
								<div class="col-lg-6 col-12">
									<div class="form-group">
										<label>Nama Produk</label>
										<input type="text" value="<?= $product->nama_produk ?>" name="nama" class="form-control" id="">
										<input type="hidden" value="<?= $product->id ?>" name="id" class="form-control" id="">
									</div>
									<div class="form-group">
										<label>Harga</label>
										<input type="number" value="<?= $product->harga ?>" name="harga" class="form-control" id="">
									</div>
									<div class="form-group">
										<label>Jumlah</label>
										<input type="number" value="<?= $product->jumlah ?>" name="jumlah" class="form-control" id="">
									</div>
								</div>
								<div class="col-lg-6 col-12">
									<div class="form-group">
										<label>Keterangan</label>
										<textarea name="keterangan" class="form-control" id="" cols="30" rows="10"><?= $product->keterangan ?></textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	<?php endforeach; ?>

	<script src="<?= base_url('assets/dist/js/jquery.min.js') ?>"></script>
	<script src="<?= base_url('assets/dist/js/bootstrap.min.js') ?>"></script>
</body>

</html>