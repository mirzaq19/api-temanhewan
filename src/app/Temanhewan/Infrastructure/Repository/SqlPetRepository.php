<?php

namespace App\Temanhewan\Infrastructure\Repository;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\Gender;
use App\Temanhewan\Core\Domain\Model\Race;
use App\Temanhewan\Core\Domain\Model\UserId;
use DateTime;
use App\Temanhewan\Core\Domain\Repository\PetRepository;
use App\Temanhewan\Core\Domain\Model\PetId;
use App\Temanhewan\Core\Domain\Model\Pet;
use Exception;
use Illuminate\Support\Facades\DB;

class SqlPetRepository implements PetRepository{

    /**
     * @throws TemanhewanException
     */
    public function byId(PetId $id): ?Pet
    {
        $pet_row = DB::table('pets')->where('id', $id->id())->first();

        if ($pet_row === null) {
            return null;
        }

        return $this->convertRowToPet($pet_row);
    }

    /**
     * @throws TemanhewanException
     */
    public function listPet(UserId $userId,int $offset, int $limit): array
    {
        $pets_row = DB::table('pets')
                    ->where('user_id','=',$userId->id())
                    ->offset($offset)
                    ->limit($limit)
                    ->get();

        $pets = [];

        foreach($pets_row as $pet){
            $pets[] = $this->convertRowToPet($pet);
        }

        return $pets;
    }

    /**
     * @throws TemanhewanException
     * @throws Exception
     */
    public function convertRowToPet($pet_row): Pet
    {
        return new Pet(
            new PetId($pet_row->id),
            $pet_row->name,
            $pet_row->profile_image,
            $pet_row->description,
            new Race($pet_row->race),
            new Gender($pet_row->gender),
            new UserId($pet_row->user_id)
        );
    }

    public function save(Pet $pet): void
    {
        DB::table('pets')->insert([
            'id' => $pet->getId()->id(),
            'name' => $pet->getName(),
            'profile_image' => $pet->getProfileImage(),
            'description' => $pet->getDescription(),
            'race' => $pet->getRace()->getValue(),
            'gender' => $pet->getGender()->getValue(),
            'user_id' => $pet->getUserId()->id(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    public function delete(Pet $pet): void
    {
        DB::table('pets')->delete($pet->getId()->id());
    }
}
