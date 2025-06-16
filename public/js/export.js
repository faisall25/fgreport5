$(function(){
    $('#mauexport').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                text: 'Print Data',
                title: '',
                customize: function (win) {
                    let regu = $('#regu').val();
                    let shift = $('#shift').val();
                    let waktu = new Date().toLocaleString('id-ID');

                    $(win.document.body).prepend(`
                        <div>
                            <p style="margin:0;"><strong>PT INDOFOOD FORTUNA MAKMUR SEMARANG</strong></p>
                            <p style="margin:0;"><strong>PRODUCTION DEPARTEMENT</strong></p>
                        </div>
                        <div style="text-align: center; ">
                            <h1 style="margin:0; font-size: 18pt;"><strong>HASIL PRODUKSI</strong></h1>
                            <p style="margin:0;">F.09 / SFSMG - PROD - 08</p>
                        </div>
                        <div>
                            <p style="margin:0;"><strong>Tanggal</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ${new Date().toLocaleDateString()}</p>
                            <p style="margin:0;"><strong>Group/Shift</strong>&nbsp;&nbsp&nbsp;&nbsp;: ${regu}/${shift}</p>
                        </div>
                    `);

                    // Hitung total dari kolom ke-5 (index 4) — "Isi Per-pallet"
                    let total = 0;
                    $(win.document.body).find('table tbody tr').each(function () {
                        const val = parseInt($(this).find('td:eq(5)').text());
                        if (!isNaN(val)) total += val;
                    });

                    const dataTable = $(win.document.body).find('table').first();

                    // Tambahkan baris total lebih awal
                    dataTable.find('tbody').append(`
                        <tr>
                            <td colspan="5" style="text-align:center;"><strong>TOTAL</strong></td>
                            <td><strong>${total}</strong></td>
                        </tr>
                    `);

                    // Apply CSS border setelah baris total ada
                    dataTable.css({
                        'border-collapse': 'collapse',
                        'width': '100%'
                    });

                    dataTable.find('th, td').css({
                        'border': '1px solid black',
                        'padding': '6px',
                        'text-align': 'center'
                    });
                     
                    $(win.document.body).append(`
                        <br><br>
                        <table style="width: 100%; text-align: center; font-size: 10pt;">
                            <tr>
                                <td>Diserahkan,</td>
                                <td>Diterima Oleh,</td>
                                <td>Diterima Oleh,</td>
                            </tr>
                            <tr>
                                <td style="padding-top: 60px;">(.........................)</td>
                                <td style="padding-top: 60px;">(.........................)</td>
                                <td style="padding-top: 60px;">(.........................)</td>
                            </tr>
                            <tr>
                                <td>Petugas Produksi,</td>
                                <td>Petugas Gudang</td>
                                <td>Kasie / Shift Coordinator</td>
                            </tr>
                        </table>
                    `);

                    // Tambahan styling
                    $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                },
                exportOptions: {
                    columns: [0,1,2,3,4,5]
                }
            }
            ]
    });

    $('#mauexportall').DataTable({
        dom: 'Bfrtip',
        buttons: [
            
        ]
    });
})