<?php
/**
 * @author Mathieu Sévégny
 */
@session_start();
session_unset();
header('Location: ../index.php');
