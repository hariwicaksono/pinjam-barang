<!-- Page Script USER -->
<?php if($this->session->flashdata('msg')=='tambah'):?>
<script type="text/javascript">
   $.toast({
       heading: 'Success',
       text: "Simpan Data <?php echo $this->session->flashdata('flash');?> Berhasil.",
       showHideTransition: 'slide',
       icon: 'success',
       hideAfter : 5000, // `false` to make it sticky or time in miliseconds to hide after
       stack : 5,        // `fakse` to show one stack at a time count showing the number of toasts that can be shown at once
       position: 'bottom-right',
       bgColor: '#7EC857'
   });
</script>
<?php elseif($this->session->flashdata('msg')=='edit'):?>
<script type="text/javascript">
   $.toast({
       heading: 'Info',
       text: "Edit Data <?php echo $this->session->flashdata('flash');?> Berhasil.",
       showHideTransition: 'slide',
       icon: 'info',
       hideAfter : 5000, // `false` to make it sticky or time in miliseconds to hide after
       stack : 5,        // `fakse` to show one stack at a time count showing the number of toasts that can be shown at once
       position: 'bottom-right',
       bgColor: '#00C9E6'
   });
</script>
<?php elseif($this->session->flashdata('msg')=='hapus'):?>
<script type="text/javascript">
   $.toast({
       heading: 'Success',
       text: "Hapus Data <?php echo $this->session->flashdata('flash');?> Berhasil.",
       showHideTransition: 'slide',
       icon: 'warning',
       hideAfter : 5000, // `false` to make it sticky or time in miliseconds to hide after
       stack : 5,        // `fakse` to show one stack at a time count showing the number of toasts that can be shown at once
       position: 'bottom-right',
       bgColor: '#dd4b39'
   });
</script>
<?php elseif($this->session->flashdata('msg')=='gagal'):?>
<script type="text/javascript">
   $.toast({
       heading: 'Gagal',
       text: "Hapus Data <?php echo $this->session->flashdata('flash');?> Gagal.",
       showHideTransition: 'slide',
       icon: 'warning',
       hideAfter : 5000, // `false` to make it sticky or time in miliseconds to hide after
       stack : 5,        // `fakse` to show one stack at a time count showing the number of toasts that can be shown at once
       position: 'bottom-right',
       bgColor: '#dd4b39'
   });
</script>
<?php elseif($this->session->flashdata('msg')=='export'):?>
<script type="text/javascript">
   $.toast({
       heading: 'Success',
       text: "Export Data <?php echo $this->session->flashdata('flash');?> Berhasil.",
       showHideTransition: 'slide',
       icon: 'info',
       hideAfter : 5000, // `false` to make it sticky or time in miliseconds to hide after
       stack : 5,        // `fakse` to show one stack at a time count showing the number of toasts that can be shown at once
       position: 'bottom-right',
       bgColor: '#00C9E6'
   });
</script>
<?php elseif($this->session->flashdata('msg')=='gagal-stok'):?>
<script type="text/javascript">
   $.toast({
       heading: 'Gagal',
       text: "Simpan Data <?php echo $this->session->flashdata('flash');?> Gagal. Stok Barang Tidak Tersedia.",
       showHideTransition: 'slide',
       icon: 'warning',
       hideAfter : 5000, // `false` to make it sticky or time in miliseconds to hide after
       stack : 5,        // `fakse` to show one stack at a time count showing the number of toasts that can be shown at once
       position: 'bottom-right',
       bgColor: '#dd4b39'
   });
</script>
<?php endif;?>