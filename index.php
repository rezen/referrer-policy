<?php 

require 'shared.php';

if ($protocol === 'http') {
    $protocols = ['http'];
}

$policy_id = $_GET['p'] ?? null;
$policy_id = !is_null($policy_id) && strlen($policy_id) === 0 ? null : $policy_id;
$policy_id = is_null($policy_id) ? $policy_id : (int) $policy_id;
$policy    = null;

// We want to show a random query param get passed in the referrer
if (!isset($_GET['h'])) {
    $rest = is_null($policy_id) ? "" : "&p=" . $policy_id;
    header("Location: index.php?h=" . md5(rand()) . $rest);
    exit();
}

if (!is_null($policy_id) && array_key_exists($policy_id, $policies)) {
    $policy = $policies[$policy_id];
    header("Referrer-Policy: {$policy['value']}");
}
?>
<html>
    <head>
        <title>Referrer-Policy</title>
        <style>
            body{
                padding: 16px;
                font-family: Arial, sans-serif;
                font-size: 14px;
                line-height: 18px;
                color: #222;
            }

            form {
                padding: 20px;
                background: #eee;
            }
    
            input,button, select{
                font-size: 16px;
            }
            .container{
                margin:0 auto;
                max-width: 1200px;
            }
            .description {
                max-width: 320px;
            }

            .table {
                cellspacing: 0;
                width: 100%;
            }
            .table th {
                padding: 8px;
            }

            .table td {
                padding: 8px 8px;
                vertical-align: top;
                border-top: solid 1px #ccc;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <section id="summary">
                <h1>Referrer-Policy</h1>
                <p>
                    When you click on links on a site, the browser can leak information about
                    the page referrer to the site it goes to. This can be problematic on 
                    pages that have secret tokens such as password resets we don't want shared. 
                    To control what information can be shared, you can leverage <strong>Referrer-Policy</strong>.
                    <a href="https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Referrer-Policy">MDN - Referrer-Policy</a>
                </p>
            </section>
            <form method="GET">
                <select name="p">
                    <option></option>
                    <?php foreach($policies as $idx => $p): ?>
                        <option value="<?php echo $idx; ?>" <?php if ($idx === $policy_id): ?> selected<?php endif; ?>>
                            <?php echo $p['value']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <input type="hidden" name="h" value="<?php echo md5(rand()); ?>">
                <button>Change</button>
            </form>
            <section id="http-header">
            <h3>Using header</h3>
            <p> You can set the <code>Referrer-Policy: *</code> header to control at a page level.</p>
            <?php if (!is_null($policy)): ?>
                <pre>Referrer-Policy: <?php echo $policy['value']; ?></pre>
                <i><?php echo $policy['description'] ?? ''; ?></i>
            <?php endif; ?>
            <ul>
                <?php foreach($domains as $key => $domain): ?>
                    <?php foreach($protocols  as $prot): ?>
                        <li>
                            <a href="<?php echo "{$prot}://{$domain}{$port}"; ?>/page.php?p=<?php echo $policy_id; ?>">
                                Url = <?php echo "{$prot}://{$domain}{$port}"; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </ul>
            </section>
            <hr />
            <section id="html-attribute">
                <h3>Using html attribute</h3>
                <p>On links you can add <code>referrerpolicy</code> to control the referrer at a link level</p>
                <table class="table" cellspacing="0">
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Try</th>
                    </tr>
                <?php foreach($policies as $idx => $policy): ?>
                    <tr>
                        <td>
                            <?php if ($idx === $policy_id): ?>
                                    *
                            <?php else: ?>
                                <a href="index.php?p=<?php echo $idx; ?>">
                                    +
                                    </a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <strong><?php echo  $policy['value']; ?>
                        </td>
                        <td>
                            <p class="description">
                                <?php echo $policy['description'] ?? ''; ?>
                            </p>
                        </td>
                        <td>
                            <ul>
                                <?php foreach($domains as $key => $domain): ?>
                                    <?php foreach($protocols  as $prot): ?>
                                        <li>
                                            <a href="<?php echo "{$prot}://{$domain}{$port}"; ?>/page.php?p=<?php echo $idx; ?>" referrerpolicy="<?php echo $policy['value']; ?>">
                                                Url = <?php echo "{$prot}://{$domain}{$port}"; ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </ul>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </section>
    </div>
</body>