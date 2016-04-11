<!-- 
// caminho do arquivo: \includes\menu.php
-->
<ul>
    <li><a href="novo.php">Novo Contato</a></li>
    <li><a href="pesquisar.php">Pesquisar</a></li>
    <li><a href="listar.php">Listar Todos</a></li>
    <li style="float:right; color: #fff">
        <a class="active" href="logout.php">
            <?php echo $_SESSION['usuario']['nome']; ?>&nbsp;&nbsp;
            <span class="sair"></span>
        </a>
    </li>
</ul>
