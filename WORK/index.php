<!DOCTYPE html>
<html>
<head>
    <title>Best Films World Rules</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<!--<!--slider-->
<!--    <link rel="stylesheet" type="text/css" href="../engine1/style.css" />-->
<!--    <script type="text/javascript" src="../engine1/jquery.js"></script>-->

</head>
<body>




<div class="container">
    <br />

    <h3 align="center">Best Films World Rules</h3>

    <br />
    <div align="right" style="margin-bottom:5px;">
        <button type="button" name="add_button" id="add_button" class="btn btn-success btn-xs">Adicionar</button>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Filme</th>
                <th>Diretor</th>
                <th>Gênero</th>
                <th>Avaliação</th>
                <th>Sinopse</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>

            </tbody>

        </table>
    </div>
</div>

</body>
</html>

<div id="apicrudModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="api_crud_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Adicionar um Filme</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Coloque o nome do Filme</label>
                        <input type="text" name="filme" id="filme" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Coloque o nome do Diretor</label>
                        <input type="text" name="diretor" id="diretor" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Coloque o nome do Genero</label>
                        <input type="text" name="genero" id="genero" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Sua Avaliação</label>
                        <input type="number" name="avaliacao" id="avaliacao" class="form-control"/>

                    </div>
                    <div class="form-group">
                        <label>Sinopse</label>
                        <input type="text" name="sinopse" id="sinopse" class="form-control" />
                    </div>



                </div>
                <div class="modal-footer">

                    <input type="hidden" name="hidden_id" id="hidden_id" />
                    <input type="hidden" name="action" id="action" value="insert" />
                    <input type="submit" name="button_action" id="button_action" class="btn btn-info" value="Insert" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </form>
        </div>
    </div>

</div>


<script type="text/javascript">
    $(document).ready(function(){

        fetch_data();

        function fetch_data()
        {
            $.ajax({
                url:"fetch.php",
                success:function(data)
                {
                    $('tbody').html(data);
                }
            })
        }

        $('#add_button').click(function(){
            $('#action').val('insert');
            $('#button_action').val('Insert');
            $('.modal-title').text('Adicionar um Filme');
            $('#apicrudModal').modal('show');
        });

        $('#api_crud_form').on('submit', function(event){
            event.preventDefault();
            if($('#filme').val() == '')
            {
                alert("Coloque o nome do Filme");
            }
            else if($('#diretor').val() == '')
            {
                alert("Coloque o nome do Diretor");
            }
            else
            {
                var form_data = $(this).serialize();
                $.ajax({
                    url:"action.php",
                    method:"POST",
                    data:form_data,
                    success:function(data)
                    {
                        fetch_data();
                        $('#api_crud_form')[0].reset();
                        $('#apicrudModal').modal('hide');
                        if(data == 'insert')
                        {
                            alert("Data Inserted using PHP API");
                        }
                        if(data == 'update')
                        {
                            alert("Data Updated using PHP API");
                        }
                    }
                });
            }
        });

        $(document).on('click', '.edit', function(){
            var id = $(this).attr('id');
            var action = 'fetch_single';
            $.ajax({
                url:"action.php",
                method:"POST",
                data:{id:id, action:action},
                dataType:"json",
                success:function(data)
                {
                    $('#hidden_id').val(id);
                    $('#filme').val(data.filme);
                    $('#diretor').val(data.diretor);
                    $('#genero').val(data.genero);
                    $('#avaliacao').val(data.avaliacao);
                    $('#sinopse').val(data.sinopse);
                    $('#action').val('update');
                    $('#button_action').val('Update');
                    $('.modal-title').text('Editar Filme');
                    $('#apicrudModal').modal('show');
                }
            })
        });

        $(document).on('click', '.delete', function(){
            var id = $(this).attr("id");
            var action = 'delete';
            if(confirm("Are you sure you want to remove this data using PHP API?"))
            {
                $.ajax({
                    url:"action.php",
                    method:"POST",
                    data:{id:id, action:action},
                    success:function(data)
                    {
                        fetch_data();
                        alert("Data Deleted using PHP API");
                    }
                });
            }
        });

    });
</script>
