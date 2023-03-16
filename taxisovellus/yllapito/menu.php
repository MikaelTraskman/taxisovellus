    <center>
        <table>
        <tr>
        <td>
            <a href="tilaukset.php" method="post" name="tilaukset"> Tilaukset </a>&nbsp;&nbsp;
        </td>
        <td>
            <a href="viestit.php" name="viestit"> Viestit </a>&nbsp;&nbsp;
        </td>
        <td>
            <a href="asetukset.php" name="asetukset"> Asetukset </a>&nbsp;&nbsp;
        </td>
        <td>
            <a href="kuvanlataus/kuvanlatauslomake.php" name="kuvanlataus"> Kuvanlataus </a>
        </td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td>
            <i><?php echo $_SESSION['kayttaja'] ?></i><hr>
            <form method="post" action="">
            <input type="submit" name="nappi" value="kirjaudu ulos">
            </form>
        <?php
        if (isset($_POST['nappi'])){
        unset($_SESSION['kayttaja']);
        header("Location:index.php");
        }
        ?>
        </td>
        </tr>
        </table>
    </center>
