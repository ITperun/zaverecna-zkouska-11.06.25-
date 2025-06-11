<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /home/perunov/zaverecna-zkouska-11.06.25-/zaverecna-zkouska/app/Presentation/Home/default.latte */
final class Template_1506fa247a extends Latte\Runtime\Template
{
	public const Source = '/home/perunov/zaverecna-zkouska-11.06.25-/zaverecna-zkouska/app/Presentation/Home/default.latte';

	public const Blocks = [
		['content' => 'blockContent'],
	];


	public function main(array $ʟ_args): void
	{
		extract($ʟ_args);
		unset($ʟ_args);

		if ($this->global->snippetDriver?->renderSnippets($this->blocks[self::LayerSnippet], $this->params)) {
			return;
		}

		$this->renderBlock('content', get_defined_vars()) /* line 1 */;
	}


	public function prepare(): array
	{
		extract($this->params);

		if (!$this->getReferringTemplate() || $this->getReferenceType() === 'extends') {
			foreach (array_intersect_key(['car' => '33'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		return get_defined_vars();
	}


	/** {block content} on line 1 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);

		echo '
<h1>Seznam aut</h1>

';
		$ʟ_tmp = $this->global->uiControl->getComponent('carForm');
		if ($ʟ_tmp instanceof Nette\Application\UI\Renderable) $ʟ_tmp->redrawControl(null, false);
		$ʟ_tmp->render() /* line 5 */;

		echo '
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        border: 1px solid black;
        padding: 5px;
        text-align: left;
    }

    th {
        background-color: #f0f0f0;
    }
</style>

<table>
    <tr>
        <th>Id</th>
        <th>Nazev</th>
        <th>Vykon</th>
        <th>Prodejna</th>
        <th>Popis</th>
        <th>Editovat</th>
    </tr>
';
		foreach ($cars as $car) /* line 33 */ {
			echo '    <tr>
        <td>';
			echo LR\Filters::escapeHtmlText($car->id) /* line 35 */;
			echo '</td>
        <td>';
			echo LR\Filters::escapeHtmlText($car->name) /* line 36 */;
			echo '</td>
        <td>';
			echo LR\Filters::escapeHtmlText($car->performance) /* line 37 */;
			echo ' kW</td>
        <td>';
			echo LR\Filters::escapeHtmlText($car->store->name) /* line 38 */;
			echo '</td>
        <td>';
			echo LR\Filters::escapeHtmlText($car->description) /* line 39 */;
			echo '</td>
        <td><a href="';
			echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('edit', ['id' => $car->id])) /* line 40 */;
			echo '">Upravit</a></td>
    </tr>
';

		}

		echo '</table>

';
	}
}
