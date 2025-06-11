<?php

declare(strict_types=1);

use Latte\Runtime as LR;

/** source: /home/perunov/zaverecna-zkouska-11.06.25-/zaverecna-zkouska/app/Presentation/Home/edit.latte */
final class Template_fa0e344472 extends Latte\Runtime\Template
{
	public const Source = '/home/perunov/zaverecna-zkouska-11.06.25-/zaverecna-zkouska/app/Presentation/Home/edit.latte';

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


	/** {block content} on line 1 */
	public function blockContent(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);

		echo '
<h1>Edit control car form</h1>

';
		$ʟ_tmp = $this->global->uiControl->getComponent('carForm');
		if ($ʟ_tmp instanceof Nette\Application\UI\Renderable) $ʟ_tmp->redrawControl(null, false);
		$ʟ_tmp->render() /* line 5 */;

		echo '
<p>
    <a href="';
		echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link('default')) /* line 8 */;
		echo '">Go back!</a>
</p>

';
	}
}
