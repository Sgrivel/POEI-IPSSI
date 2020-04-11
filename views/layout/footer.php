    
    <footer>
        <div>
            <?php if (defined("DEBUG_TIME")): ?>
                Page générée en <?= round(1000 * (microtime(true) - DEBUG_TIME), 2) ?> ms
            <?php endif ?>
        </div>
    </footer>
</body>
</html>