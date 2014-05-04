<?php
use Baum\Node;

/**
* Menu
*/
class Menu extends Node {

  /**
   * Table name.
   *
   * @var string
   */
  protected $table = 'menus';


  /**
   * Construit un tableau destiné à la liste de sélection pour un input de type select :
   *
   * @return Response
   */
  public static function listForInputSelect() { // aFa faire du récursif avec passage de la depth en argument
    $menus = Menu::roots()->orderBy('id')->get();
//    var_dump($items_racines); // CTRL

    $menuslist[0] = 'Créer un nouveau menu';

    foreach ($menus as $menu)
    {
      $menuslist[$menu->etiquette][$menu->id] = 'Placer à la racine de '.$menu->etiquette;
      foreach($menu->getImmediateDescendants() as $item)
      {
        $menuslist[$menu->etiquette][$item->id] = '• Enfant de '.$item->etiquette;
        foreach($item->getImmediateDescendants() as $item2)
        {
          $menuslist[$menu->etiquette][$item2->id] = '•• Enfant de '.$item2->etiquette;
        }
      }
    }
    return $menuslist;
  }

  /**
   * Trie les collections des descendants d'un node par "rang"
   *
   * @return collection
   */
  public static function immediateDescSortByRang($menu) {
    $collection = $menu->getImmediateDescendants();
//    var_dump($collection); // CTRL

    $collection = $collection->sortBy(function($collection)
    {
      return $collection->rang;
    });

    return $collection;
  }

  /* —————————  Créer un objet Menu pour le formulaire de création  —————————————————*/

  public static function fillFormForCreate()
  {
    $menu = new Menu();
    $strings = [
    'nom_sys' => 'Saisir un nom “système”',
    'publication' => 0,
    'description' => 'Saisir une description',
    ];
    $menu->fill($strings);
    return $menu;
  }

  /* —————————  MUTATORS  —————————————————*/



//////////////////////////////////////////////////////////////////////////////

  //
  // Below come the default values for Baum's own Nested Set implementation
  // column names.
  //
  // You may uncomment and modify the following fields at your own will, provided
  // they match *exactly* those provided in the migration.
  //
  // If you don't plan on modifying any of these you can safely remove them.
  //

  // /**
  // * Column name which stores reference to parent's node.
  // *
  // * @var int
  // */
  // protected $parentColumn = 'parent_id';

  // /**
  // * Column name for the left index.
  // *
  // * @var int
  // */
  // protected $leftColumn = 'lft';

  // /**
  // * Column name for the right index.
  // *
  // * @var int
  // */
  // protected $rightColumn = 'rgt';

  // /**
  // * Column name for the depth field.
  // *
  // * @var int
  // */
  // protected $depthColumn = 'depth';

  // /**
  // * With Baum, all NestedSet-related fields are guarded from mass-assignment
  // * by default.
  // *
  // * @var array
  // */
  // protected $guarded = array('id', 'parent_id', 'lft', 'rgt', 'depth');

  //
  // This is to support "scoping" which may allow to have multiple nested
  // set trees in the same database table.
  //
  // You should provide here the column names which should restrict Nested
  // Set queries. f.ex: company_id, etc.
  //

  // /**
  //  * Columns which restrict what we consider our Nested Set list
  //  *
  //  * @var array
  //  */
  // protected $scoped = array();

  //////////////////////////////////////////////////////////////////////////////

  //
  // Baum makes available two model events to application developers:
  //
  // 1. `moving`: fired *before* the a node movement operation is performed.
  //
  // 2. `moved`: fired *after* a node movement operation has been performed.
  //
  // In the same way as Eloquent's model events, returning false from the
  // `moving` event handler will halt the operation.
  //
  // Below is a sample `boot` method just for convenience, as an example of how
  // one should hook into those events. This is the *recommended* way to hook
  // into model events, as stated in the documentation. Please refer to the
  // Laravel documentation for details.
  //
  // If you don't plan on using model events in your program you can safely
  // remove all the commented code below.
  //

  // /**
  //  * The "booting" method of the model.
  //  *
  //  * @return void
  //  */
  // protected static function boot() {
  //   // Do not forget this!
  //   parent::boot();

  //   static::moving(function($node) {
  //     // YOUR CODE HERE
  //   });

  //   static::moved(function($node) {
  //     // YOUR CODE HERE
  //   });
  // }

}
