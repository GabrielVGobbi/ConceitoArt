


$(function () {
  var BASE_URL = 'http://www2.linkbio.com.br/admin/';
  $('.new_image').on('click', function(e){
    e.preventDefault();
    html = '<form method="GET" action="'+BASE_URL+'home/action">';
    html += '<label>Novo link</label><input type="text" class="form-control" name="name_link" placeholder="Nome do link" id="name_link" value=""><div class="input-group" style="margin-bottom:12px;">';
    html += '';
    html += '<span class="input-group-addon">www.</span><input type="text" class="form-control" name="desc_link" id="desc_link" value=""><span class="input-group-addon">.com.br</span><span class="input-group-addon">/</span><input type="text" class="form-control" name="desc_sub_link" id="desc_sub_link" value=""><span class="input-group-addon"><button type="submit">Save</button></span>';
    html += ' </div><div class="box-footer"></div>';
    html += '</form>';
    $('.new_link').append(html);
  });

});


function Modal($id, $modal) {

  if ($modal == 'modalVisualizar'){
    $('#modalVisualizar'+$id).modal('show');
  }else if($modal == 'modalCadastrar'){
    $('#modalCadastrar').modal('show');
  }
}

/*  function new_situation($id,$venda){

    if($venda == 0){

      html = '<div class="col-md-6"><div class="form-group"><label>Situação</label><input type="text" class="form-control"  name="descricao_situacao" id="descricao_situacao" autocomplete="off"></div>';
      html += '</div> <div class="col-md-2"> <div class="form-group"><label>Data</label><input type="text" class="form-control"  name="data_situacao" id="data_situacao" autocomplete="off"></div></div>';
      html += '<div class="col-md-2"><div class="form-group"><label>Preço</label> <input type="text" class="form-control"  name="preco_situacao" id="preco_situacao" autocomplete="off"></div></div>';
      html += '<div class="col-md-2"><div class="form-group"> <label>Venda</label><select class="form-control " name="situacao_char" id="situacao_char"><option value="1">  Vendido</option><option selected="selected" value="0">Não vendido</option></select></div></div>';

      $('.situation'+$id).append(html);
    }
  }*/


  $(function () {

    $('.new_image').on('click', function(e){
      e.preventDefault();

      $('.fotos').append('<input type="file" name="fotos[]" multiple />');
    });

  });

  $(function () {

    $('.new_situation').on('click', function(e){
      e.preventDefault();

      html = '<div class="col-md-6"><div class="form-group"><label>Situação</label><input type="text" class="form-control"  name="descricao_situacao" id="descricao_situacao" autocomplete="off"></div>';
      html += '</div> <div class="col-md-2"> <div class="form-group"><label>Data</label><input type="text" class="form-control"  name="data_situacao" id="data_situacao" autocomplete="off"></div></div>';
      html += '<div class="col-md-2"><div class="form-group"><label>Preço</label> <input type="text" class="form-control"  name="preco_situacao" id="preco_situacao" autocomplete="off"></div></div>';
      html += '<div class="col-md-2"><div class="form-group"> <label>Venda</label><select class="form-control " name="situacao_char" id="situacao_char"><option value="1">  Vendido</option><option selected="selected" value="0">Não vendido</option></select></div></div>';

      $('.situation').append(html);

    });

  });


  $(function () {

    if($('.spanModalAvancer').bind('click', function(){

      id_proximo = parseInt($(this).attr('id')) + parseInt(1);
      id_inventario = $(this).attr('id');
      
      $('#modalVisualizar'+id_inventario).modal('toggle');

      $('#modalVisualizar'+id_inventario).on('hidden.bs.modal', function (e) {

        $("#modalVisualizar"+id_proximo).modal({

          'show': true,
          'keyboard': true,
          'foco': true

        });
        
      })

    }));

     if($('.spanModalRetorn').bind('click', function(){

      id_proximo = parseInt($(this).attr('id')) - parseInt(1);
      id_inventario = $(this).attr('id');
      
      $('#modalVisualizar'+id_inventario).modal('toggle');

      $('#modalVisualizar'+id_inventario).on('hidden.bs.modal', function (e) {

        $("#modalVisualizar"+id_proximo).modal({

          'show': true,
          'keyboard': true,
          'foco': true

        });
      })


    }));
   });


  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
    {
      ranges   : {
        'Today'       : [moment(), moment()],
        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate  : moment()
    },
    function (start, end) {
      $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
  $(function () {



    $('input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //marcar todos os CheckBox
    $('#marcarTodos').on('ifChecked', function (event) {
      $('.check').each(function () {
        $(this).iCheck('check');
      });
    });

    //Desmarcar todos os checkbox 
    $('#marcarTodos').on('ifUnchecked', function (event) {
      $('.check').each(function () {
        $(this).iCheck('uncheck');
      });
    });


    $('#mercado_live').on('ifChecked', function (event) {
      $('.dados-ml').show();
    });

    $('#mercado_live').on('ifUnchecked', function (event) {
      $('.dados-ml').hide();
    });

    $(".mailbox-star").click(function (e) {
      e.preventDefault();
      //detect type
      var $this = $(this).find("a > i");
      var glyph = $this.hasClass("glyphicon");
      var fa = $this.hasClass("fa");

      if (glyph) {
        $this.toggleClass("glyphicon-star");
        $this.toggleClass("glyphicon-star-empty");
      }

      if (fa) {
        $this.toggleClass("fa-star");
        $this.toggleClass("fa-star-o");
      }
    });
  });

  $(function(){
    $('[data-toggle="popover"]').popover({html:true});

    $(document).on('click', '.pop-hide', function(){
      $('.pop').popover('hide');
    });

  });

  $(function(){
    // ARRAY DOS IDS 
    var ids = [];


    $('.check').on('ifChecked', function(){
      ids.push($(this).val());

    });

    $('.check').on('ifUnchecked', function(){
      ids.pop($(this).val());

    });



    $('#btnGerarEtiqueta').on('click',function(){
      if(ids.length > 0){
        $.ajax({
          type: 'POST',
          url: BASE_URL+'relatorio/gerarEtiquetaMercadolivre',
          data: 'check=' + ids,
          dataType: 'HTML',
          success: function(data){
           content = window.open();
           content.document.write(data);
           content.print();
           content.close();
         }
       });

      }else{
       swal("Oops!!","Por favor, selecione um registro!!","error");
     }
   });

    $('#btnGerarRelatorio').on('click',function(){
      if(ids.length > 0){
        $.ajax({
          type: 'POST',
          url: BASE_URL+'xls/gerarEtiquetaMercadolivre',
          data: 'check=' + ids,
          dataType: 'HTML',
          success: function(data){
           $('.box-body').html(data);
         }
       });

      }else{
        alert('Selecione um cliente');
      }
    });

    $('#btnImprimir').on('click',function(){
      if(ids.length > 0){
        $.ajax({
          type: 'POST',
          url: BASE_URL+'xls/gerarEtiquetaMercadolivre',
          data: 'check=' + ids,
          dataType: 'HTML',
          success: function(data){
           content = window.open();
           content.document.write(data);
           content.print();
           content.close();
         }
       });

      }else{

  /*      var msg = 'Por favor, Selecione ao menos um registro';

  $('#modalError').modal('show');
  $( "#editar-id" ).html(msg);

  setTimeout(function(){ $('#modalError').modal('hide'); }, 2000);*/
  swal("Oops!!","Por favor, selecione um registro!!","error");


}
});


  });


  function selectArtist(obj){
    var id = $(obj).attr('data-id');
    var name = $(obj).html();

    $(".span-artist").css("border-color","#09a916"); 
    $('.searchresultsArtista').hide();
    $('#artista').val(name);
    $('#id_artista').val(id);
  }

  function add_situacao() {

    $('#modal123').show();
  }

  function add_artista(obj){
    var name = $('#artista').val();

    if(name != '' ) {

      swal({
        title: "Tem certeza",
        text: "Você esta adicionando um artista: " +name,
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({

            url:BASE_URL+'ajax/add_artista',
            type: 'POST',
            data:{name:name},
            dataType:'json',
            success:function(json){
              swal({
                title: "Sucesso!",
                text: "Cadastro efetuado com sucesso",
                icon: "success",


              })
              $(".span-artist").css("border-color","#09a916"); 
              $('.searchresultsArtista').hide();
              console.log(json);
              $('#id_artista').val(json.id);

            },
            error: function (data) {
              swal({
                title: "Oops!!",
                text: "Ja existe um artista: " +name,
                icon: "warning",


              })
            }

          });
        } else {

        }
      });
    }
  }

  function add_tecnica(obj){
    var name = $('#tecnica').val();

    if(name != '' ) {

      swal({
        title: "Tem certeza",
        text: "Você esta adicionando uma tecnica " +name,
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({

            url:BASE_URL+'ajax/add_tecnica',
            type: 'POST',
            data:{name:name},
            dataType:'json',
            success:function(json){
              swal({
                title: "Sucesso!",
                text: "Cadastro efetuado com sucesso",
                icon: "success",
              })
              $(".span-tecnica").css("border-color","#09a916"); 
              $('.searchresultsTecnica').hide();
              $('#id_tecnica').val(json.id);

            },
            error: function (data) {
              swal({
                title: "Oops!!",
                text: "Ja existe uma tecnica: " +name,
                icon: "warning",


              })
            }

          });
        } else {

        }
      });
    }
  }

  $(function(){

    $('.tabitem').on('click', function(){

      $('.activetab').removeClass('activetab');
      $(this).addClass('activetab');

      var item = $('.activetab').index();
      $('.tabbody').hide();
      $('.tabbody').eq(item).show();

    });

    $('#busca').on('focus', function(){
      $(this).animate({
        width:'250px'
      }, 'fast');
    });

    $('#busca').on('blur', function(){
      if($(this).val() == '') {
        $(this).animate({
          width:'100px'
        }, 'fast');
      }

      setTimeout(function(){
        $('.searchresults').hide();
      }, 500);
    });

    $('#artista').on('keyup', function(){
      var datatype = $(this).attr('data-type');
      var q = $(this).val();

      if(datatype != '') {
        $.ajax({
          url:BASE_URL+'ajax/'+datatype,
          type:'GET',
          data:{q:q},
          dataType:'JSON',
          success:function(json) {
            if( $('.searchresultsArtista').length == 0 ) {
              $('#art').after('<div class="searchresultsArtista"></div>');

            }

            $('.searchresultsArtista').css('left', $('#art').offset().left+'px');
            $('.searchresultsArtista').css('top', $('#art').offset().top+$('#art').height()+5+'px');

            var html = '';

            for(var i in json) {
              html += '<li class="select2-results__option"  role="treeitem" aria-selected="true" href="javascript:;" onclick="selectArtist(this)" data-id="'+json[i].id+'">'+json[i].name+'</li>';
            }

            $('.searchresultsArtista').html(html);
            $('.searchresultsArtista').show();
          }
        });
      }

    });

  });


  $(function(){



    $('#tecnica').on('keyup', function(){
      var datatype = $(this).attr('data-type');
      var tecnica = $(this).val();

      if(datatype != '') {
        $.ajax({
          url:BASE_URL+'ajax/'+datatype,
          type:'GET',
          data:{tecnica:tecnica},
          dataType:'JSON',
          success:function(json) {
            if( $('.searchresultsTecnica').length == 0 ) {
              $('#tec').after('<div class="searchresultsTecnica"></div>');

            }

            $('.searchresultsTecnica').css('left', $('#art').offset().left+'px');
            $('.searchresultsTecnica').css('top', $('#art').offset().top+$('#art').height()+5+'px');

            var html = '';

            for(var i in json) {
              html += '<li class="select2-results__option"  role="treeitem" aria-selected="true" href="javascript:;" onclick="selectTecnica(this)" data-id="'+json[i].idTecnica+'">'+json[i].nameTecnica+'</li>';
            }

            $('.searchresultsTecnica').html(html);
            $('.searchresultsTecnica').show();
          }
        });
      }

    });

  });

  function selectTecnica(obj){
    var idTecnica = $(obj).attr('data-id');
    var nameTecnica = $(obj).html();

    $(".span-tecnica").css("border-color","#09a916"); 

    $('.searchresultsTecnica').hide();
    $('#tecnica').val(nameTecnica);
    $('#id_tecnica').val(idTecnica);
  }


  $('#mercado_livre').on('ifChecked', function(){
    $('.dados-ml').show();

  });

  $('#mercado_livre').on('ifUnchecked', function(){
    $('.dados-ml').hide();

  });

  function formatar(src, mask) 
  {
    var i = src.value.length;
    var saida = mask.substring(0,1);
    var texto = mask.substring(i)
    if (texto.substring(0,1) != saida) 
    {
      src.value += texto.substring(0,1);
    }
  }



  function verInventario($id) {
    $('#modalVisualizar'+$id).modal('show');
  }

  function modalEdit($id, $tipoDeModal) {
    if($tipoDeModal == 'Descricao'){
      $('#modalEdit'+$id).modal('show');
      $('.descricao').show();
      $('.situacao').hide();

    }else {
     $('#modalEdit'+$id).modal('show');
     $('.situacao').show();
     $('.descricao').hide();
   }
 }

 function filterShow() {

  $('.filter').toggle();
}


function gerarRelatorio() {
  $( "#gerar_relatorio_page" ).show("slow");
  $( "#gerar_recibo_page" ).hide("slow");
  
}

function gerarRecibo() {

  $( "#gerar_recibo_page" ).show("slow");
  $( "#gerar_relatorio_page" ).hide("slow");
  
}


function optionChange() {
   
  if($( "#Filtros[situacao]" ).val() == 0){
    
    $( "#venda_div" ).hide("slow");
  }else {
    $( "#venda_div" ).show("slow");
  }
   
}

function tpiRelatorio() {
   
  if(document.getElementById("tpi_relatorio").value == "rel_venda"){
    
    $( "#rel_venda" ).show("slow");
  }else {
    $( "#rel_venda" ).hide("slow");
  }
   
}

function modalEdit($id, $tipoDeModal) {
    if($tipoDeModal == 'Descricao'){
      $('#modalEdit'+$id).modal('show');
      $('.descricao').show();
      $('.situacao').hide();

    }else {
     $('#modalEdit'+$id).modal('show');
     $('.situacao').show();
     $('.descricao').hide();
   }
 }







