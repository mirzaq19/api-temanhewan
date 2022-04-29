<?php

namespace App\Temanhewan\Infrastructure\Repository;

use App\Temanhewan\Core\Application\Service\CreateUser\CreateUserRequest;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\Gender;
use App\Temanhewan\Core\Domain\Model\Role;
use App\Temanhewan\Core\Domain\Model\User;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\UserRepository;
use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;

class SqlUserRepository implements UserRepository
{
    /**
     * @throws TemanhewanException
     */
    public function byId(UserId $id): ?User
    {
        $user_row = DB::table('users')->where('id', $id->id())->first();

        if ($user_row === null) {
            return null;
        }

        return $this->convertRowToUser($user_row);
    }

    /**
     * @throws TemanhewanException
     * @throws Exception
     */
    public function convertRowToUser(object $user_row): User
    {
        return new User(
            $user_row->id,
            $user_row->name,
            $user_row->profile_image,
            new DateTime($user_row->birthdate),
            $user_row->username,
            new Gender($user_row->gender),
            new Role($user_row->role),
            $user_row->balance,
            $user_row->email,
            $user_row->password,
            $user_row->address,
            $user_row->phone
        );
    }

    /**
     * @throws Exception
     */
    public function convertRequestToUser(CreateUserRequest $request, string $profile_image_name): User
    {
        return new User(
            new UserId(),
            $request->getName(),
            $profile_image_name,
            new DateTime($request->getBirthDate()),
            $request->getUsername(),
            new Gender($request->getGender()),
            new Role($request->getRole()),
            0,
            $request->getEmail(),
            bcrypt($request->getPassword()),
            $request->getAddress(),
            $request->getPhone()
        );
    }

    public function save(User $user): void
    {
        DB::table('users')->insert([
            'id' => $user->getId()->id(),
            'name' => $user->getName(),
            'profile_image' => $user->getProfileImage(),
            'birthdate' => $user->getBirthDate()->format('Y-m-d'),
            'username' => $user->getUsername(),
            'gender' => $user->getGender()->getValue(),
            'role' => $user->getRole()->getValue(),
            'balance' => $user->getBalance(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'address' => $user->getAddress(),
            'phone' => $user->getPhone(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
