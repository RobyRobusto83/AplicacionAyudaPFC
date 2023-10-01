<?php 

declare(strict_types=1);

use App\Pfc\application\NewPfc\NewPfcApplication;
use PHPUnit\Framework\TestCase;

final class NewPfcAppliacationTest extends TestCase
{
    /** @test */
   public function if_pfc_exists_throw_exception(): void 
   {
        $this->expectException(\Exception::class);
        $pfc = new NewPfcApplication();
        $pfc->execute(["id" => "test"]);
   }
}