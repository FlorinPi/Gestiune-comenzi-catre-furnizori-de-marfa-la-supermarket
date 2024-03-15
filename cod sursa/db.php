<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <script src='scripts/tabs.js'></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>BD</title>
</head>
<body>

<div class="container">
    
    <!-- Verificarea conectarii la baza de date folosind contul de administrator -->
    <?php
        require_once 'includes/config_session.inc.php';

        if(isset($_SESSION["admin_id"])){
    ?>

    <div class="header">
        <div class="tab">
            <button class="tablinks" onclick="openCity(event, 'Furnizori')" id="defaultOpen">Furnizori</button>
            <button class="tablinks" onclick="openCity(event, 'CategoriiProduse')">Categorii Produse</button>
            <button class="tablinks" onclick="openCity(event, 'Produse')">Produse</button>
            <button class="tablinks" onclick="openCity(event, 'Comenzi')">Comenzi</button>
            <button class="tablinks" onclick="openCity(event, 'Stoc')">Stocuri</button>
        </div>
        <!-- Deconectare de la baza de date -->
        <div class="logout-btn">
            <form action="includes/logout.inc.php" method="post">
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>

    <!-- Tabela Furnizori: afisare si modificare elemente -->
    <div id="Furnizori" class="tabcontent">

    <h3>Furnizori</h3>
    <?php require_once 'int_fardejoin/select_fur.php'; ?>
    <table>

    <tr>
        <td>Nume</td>
        <td>Strada</td>
        <td>Nr</td>
        <td>Localitate</td>
        <td>Telefon</td>
        <td>Email</td>
    </tr>

    <?php while($rows=$stmt->fetch(PDO::FETCH_ASSOC)){ ?>
            
            <tr>
                <td><?php echo $rows['Nume'];?></td>
                <td><?php echo $rows['Strada'];?></td>
                <td><?php echo $rows['Nr'];?></td>
                <td><?php echo $rows['Localitate'];?></td>
                <td><?php echo $rows['Telefon'];?></td>
                <td><?php echo $rows['Email'];?></td>
            </tr>
    
    <?php } ?>

    </table>

    <h3>Numarul de produse ale fiecarui furnizor in functie de localitate</h3>
    
    <form method="post" action="db.php">
        <label for="localitate">Alege Localitate:</label>
        <select name="localitate">
            <option value="Bucuresti">Bucuresti</option>
            <option value="Cluj-Napoca">Cluj-Napoca</option>
        </select>
    </form>

    <div id="nrProduseContent"></div>

    <!--Functie pentru a actualiza tabela in timp real, in functie de parametrii selectati-->
    <script>
        function updateCity(city) {
            $.ajax({
                url: 'int_simple/select_nrprd.php',
                method: 'POST',
                data: { localitate: city },
                success: function(data) {
                    $('#nrProduseContent').html(data);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }

        updateCity('Bucuresti');

        $('select[name="localitate"]').on('change', function() {
            var selectedCity = $(this).val();
            updateCity(selectedCity);
        });
    </script>

    

    <h3>Valoarea totala a fiecarui furnizor</h3>
    <?php require_once 'int_complex/select_furprt.php'; ?>
    <table>

    <tr>
        <td>Nume</td>
        <td>SumaTotala</td>
    </tr>

    <?php while($rows=$stmt->fetch(PDO::FETCH_ASSOC)){ ?>
            
            <tr>
                <td><?php echo $rows['Nume'];?></td>
                <td><?php echo $rows['TotalPret'];?></td>
            </tr>
    
    <?php } ?>

    </table>
    
    <h3>Insert</h3>

    <form action="iud/insert_fur.php" method="post">
        <input type="text" name="nume" placeholder="Nume">
        <input type="text" name="strada" placeholder="Strada">
        <input type="text" name="nr" placeholder="Numar">
        <input type="text" name="localitate" placeholder="Localitate">
        <input type="text" name="telefon" placeholder="Telefon">
        <input type="text" name="email" placeholder="Email">
        <button>Insert</button>
    </form>

    <h3>Update</h3>

    <form action="iud/update_fur.php" method="post">
        <input type="text" name="nume" placeholder="Nume">
        <input type="text" name="nou" placeholder="Nume nou">
        <button>Update</button>
    </form>

    <h3>Delete</h3>

    <form action="iud/delete_fur.php" method="post">
        <input type="text" name="nume" placeholder="Nume">
        <button>Delete</button>
    </form>
    </div>

    <!-- Tabela CategoriiProduse: afisare si modificare elemente -->
    <div id="CategoriiProduse" class="tabcontent">

    <h3>Categorii Produse</h3>
    <?php require_once 'int_fardejoin/select_cat.php'; ?>
    <table>

    <tr>
        <td>Nume Categorie</td>
        <td>Descriere</td>
    </tr>

    <?php while($rows=$stmt->fetch(PDO::FETCH_ASSOC)){ ?>
            
            <tr>
                <td><?php echo $rows['NumeCategorie'];?></td>
                <td><?php echo $rows['Descriere'];?></td>
            </tr>

    <?php } ?>

    </table>

    <h3>Produsul cel mai scump din fiecare categorie</h3>
    <?php require_once 'int_complex/select_catmaxprt.php'; ?>
    <table>

    <tr>
        <td>Nume Categorie</td>
        <td>Nume Produs</td>
        <td>Pret</td>
    </tr>

    <?php while($rows=$stmt->fetch(PDO::FETCH_ASSOC)){ ?>
            
            <tr>
                <td><?php echo $rows['NumeCategorie'];?></td>
                <td><?php echo $rows['NumeProdus'];?></td>
                <td><?php echo $rows['Pret'];?></td>
            </tr>

    <?php } ?>

    </table>
    
    <h3>Insert</h3>

    <form action="iud/insert_cat.php" method="post">
        <input type="text" name="numecat" placeholder="Nume Categorie">
        <input type="text" name="desc" placeholder="Descriere">
        <button>Insert</button>
    </form>

    <h3>Update</h3>

    <form action="iud/update_cat.php" method="post">
        <input type="text" name="numecat" placeholder="Nume Categorie">
        <input type="text" name="nou" placeholder="Nume nou">
        <button>Update</button>
    </form>

    <h3>Delete</h3>

    <form action="iud/delete_cat.php" method="post">
        <input type="text" name="numecat" placeholder="Nume Categorie">
        <button>Delete</button>
    </form>
    </div>

    <!-- Tabela Produse: afisare elemente -->
    <div id="Produse" class="tabcontent">

    <h3>Produse</h3>
    <?php require_once 'int_simple/select_prd.php'; ?>
    <table>

    <tr>
        <td>NumeProdus</td>
        <td>Pret</td>
        <td>Categorie</td>
        <td>Furnizor</td>
    </tr>

    <?php while($rows=$stmt->fetch(PDO::FETCH_ASSOC)){ ?>
            
            <tr>
                <td><?php echo $rows['NumeProdus'];?></td>
                <td><?php echo $rows['Pret'];?></td>
                <td><?php echo $rows['NumeCategorie'];?></td>
                <td><?php echo $rows['Nume'];?></td>
            </tr>
    
    <?php } ?>

    </table>

    <h3>Sortare produse in functie de pret</h3>
    <div>
        <label for="minPrice">Valoare Minima:</label>
        <input type="number" id="minPrice" name="minPrice" value="0" min="0">
        <label for="maxPrice">Valoare Maxima:</label>
        <input type="number" id="maxPrice" name="maxPrice" value="100" min="0">
        <button onclick="updateContent()">Update</button>
    </div>

    <div id="priceRangeContent"></div>

    <!--Functie pentru a actualiza tabela in timp real, in functie de parametrii selectati-->
    <script>
        function updateContent() {
            var minPrice = $('#minPrice').val();
            var maxPrice = $('#maxPrice').val();

            $.ajax({
                url: 'int_complex/select_prdpm.php',
                method: 'POST',
                data: { minPrice: minPrice, maxPrice: maxPrice },
                success: function (data) {
                    // Update the content of the div with the received data
                    $('#priceRangeContent').html(data);
                },
                error: function (error) {
                    console.error('Error:', error);
                }
            });
        }

        updateContent();
    </script>

    </div>

    <!-- Tabela Comenzi: afisare elemente -->
    <div id="Comenzi" class="tabcontent">

    <h3>Comenzi</h3>
    <?php require_once 'int_simple/select_cmd.php'; ?>
    <table>

    <tr>
        <td>Data Comanda</td>
        <td>Furnizor</td>
        <td>Produs</td>
        <td>Cantitate</td>
        <td>Pret Unitar</td>
    </tr>

    <?php while($rows=$stmt->fetch(PDO::FETCH_ASSOC)){ ?>
            
            <tr>
                <td><?php echo $rows['DataComanda'];?></td>
                <td><?php echo $rows['Nume'];?></td>
                <td><?php echo $rows['NumeProdus'];?></td>
                <td><?php echo $rows['Cantitate'];?></td>
                <td><?php echo $rows['PretUnitar'];?></td>
            </tr>
    
    <?php } ?>

    </table>

    <h3>Comenzi din 2024</h3>
    <?php require_once 'int_simple/select_cmd24.php'; ?>
    <table>

    <tr>
        <td>Data Comanda</td>
        <td>Produs</td>
        <td>Cantitate</td>
    </tr>

    <?php while($rows=$stmt->fetch(PDO::FETCH_ASSOC)){ ?>
            
            <tr>
                <td><?php echo $rows['DataComanda'];?></td>
                <td><?php echo $rows['NumeProdus'];?></td>
                <td><?php echo $rows['Cantitate'];?></td>
            </tr>
    
    <?php } ?>

    </table>

    <h3>Cantitate totala comandata de fiecare furnizor</h3>
    <?php require_once 'int_complex/select_cmdtot.php'; ?>
    <table>

    <tr>
        <td>Nume</td>
        <td>Cantitate Totala</td>
    </tr>

    <?php while($rows=$stmt->fetch(PDO::FETCH_ASSOC)){ ?>
            
            <tr>
                <td><?php echo $rows['Nume'];?></td>
                <td><?php echo $rows['TotalCantitate'];?></td>
            </tr>
    
    <?php } ?>

    </table>

    </div>

    <!-- Tabela Stocuri: afisare elemente -->
    <div id="Stoc" class="tabcontent">

    <h3>Stocuri</h3>
    <?php require_once 'int_simple/select_stc.php'; ?>
    <table>

    <tr>
        <td>NumeProdus</td>
        <td>Cantitate</td>
    </tr>

    <?php while($rows=$stmt->fetch(PDO::FETCH_ASSOC)){ ?>
            
            <tr>
                <td><?php echo $rows['NumeProdus'];?></td>
                <td><?php echo $rows['Cantitate'];?></td>
            </tr>
    
    <?php } ?>

    </table>

    <h3>Numar mic de produse in stoc</h3>
    <?php require_once 'int_simple/select_stctr.php'; ?>
    <table>

    <tr>
        <td>NumeProdus</td>
        <td>Cantitate</td>
    </tr>

    <?php while($rows=$stmt->fetch(PDO::FETCH_ASSOC)){ ?>
            
            <tr>
                <td><?php echo $rows['NumeProdus'];?></td>
                <td><?php echo $rows['Cantitate'];?></td>
            </tr>
    
    <?php } ?>

    </table>

    </div>

    <?php             
        }
        else {
            header("Location: ./index.php");
            die();
        }
    ?>
</div>
<script>document.getElementById("defaultOpen").click();</script>
</body>
</html>