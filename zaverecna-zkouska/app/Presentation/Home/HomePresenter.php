<?php

namespace App\Presentation\Home;

use Nette;
use Nette\Application\UI\Form;
use App\Model\StoreFacade;
use App\Model\CarFacade;

final class HomePresenter extends Nette\Application\UI\Presenter
{
    private StoreFacade $storeFacade;
    private CarFacade $carFacade;

    private $editingCar = null;

    public function __construct(StoreFacade $storeFacade, CarFacade $carFacade)
    {
        parent::__construct();
        $this->storeFacade = $storeFacade;
        $this->carFacade = $carFacade;
    }

    public function renderDefault(): void
    {
        $this->template->cars = $this->carFacade->getAll();
    }

    public function renderEdit(int $id): void
    {
        $car = $this->carFacade->findById($id);
        if (!$car) {
            $this->error('Auto nebylo nalezeno.');
        }

        $this['carForm']->setDefaults([
            'name' => $car->name,
            'description' => $car->description,
            'performance' => $car->performance,
            'store_id' => $car->store_id,
        ]);

        $this->editingCar = $car;
        $this->template->editing = true;
    }

    protected function createComponentCarForm(): Form
    {
        $form = new Form;

        $form->addText('name', 'Název')
            ->setRequired('Zadejte nazev auta.');

        $form->addTextArea('description', 'Popis');

        $form->addText('performance', 'Vykon (kW)')
            ->setRequired('Zadejte vykon.')
            ->addRule(Form::FLOAT, 'Vykon musi byt realni cislo.');

        $stores = [];
        foreach ($this->storeFacade->getAll() as $store) {
            $stores[$store->id] = $store->name;
        }

        $form->addSelect('store_id', 'Prodejna', $stores)
            ->setPrompt('Vyberte prodejnu')
            ->setRequired('Vyberte prodejnu.');

        $form->addSubmit('send', 'Ulozit auto');
        $form->onSuccess[] = [$this, 'carFormSucceeded'];

        return $form;
    }

    public function carFormSucceeded(Form $form, \stdClass $values): void
    {
        $carId = $this->getParameter('id');

        $data = [
            'name' => $values->name,
            'description' => $values->description,
            'performance' => $values->performance,
            'store_id' => $values->store_id
        ];

        if ($carId) {
            $this->carFacade->update((int) $carId, $data);
            $this->flashMessage('Auto bylo upraveno.', 'success');
        } else {
            $this->carFacade->insert($data);
            $this->flashMessage('Auto bylo ppridano.', 'success');
        }

        $this->redirect('Home:default');
    }
}
