<?php 
   
   require "../modelo/db.php";
   $objConexion=Conectarse();
   $sql= "select * from productos";
   $result = $objConexion->query($sql);
   $arraycodigos = array();
?>

<table class="table">   
    <tr>
        <td>ID Producto</td>
        <td>Generar codigo de barras</td>
    </tr>
    <?php while ($ver=mysqli_fetch_row($result)): 
            $arraycodigos[]=(string)$ver[0];
        ?>
    <tr>
        <td><?php echo $ver[1]; ?></td>
        <td>
            <svg id='<?php echo "barcode".$ver[0]; ?>'> </svg>
        </td>
              
    </tr>
    <?php endwhile; ?>
</table>
<script type="text/javascript">
    function arrayjsonbarcode(j){
        json = JSON.parse(j);
        arr=[];
        for(var x in json){
            arr.push(json[x]);
        }
        return arr;
    }
    jsonvalor ='<?php echo json_encode($arraycodigos)?>';
    valores=arrayjsonbarcode(jsonvalor);

            for (var i = 0; i < valores.length; i++) {
                JsBarcode("#barcode" + valores[i], valores[i].toString(),{
                format: "codabar",
                lineColor: "#000",
                width: 2,
                height: 25,
                displayValue: true
                });
            }

</script>