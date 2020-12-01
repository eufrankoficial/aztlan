<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\User\UserRepository;
use App\Services\Interfaces\BaseServiceInterface;
use Illuminate\Http\Request;

class UserService implements BaseServiceInterface
{
    /**
     * @var UserRepository.
     */
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    function list(Request $request)
    {
        return $this->userRepository->model()->filter($request)->paginate();
    }

    function create(array $data): User
    {
        return $this->userRepository->create($data);
    }

    function update(array $data, User $user): User
    {
        return $this->userRepository->update($user->id, $data);
    }

    function delete(User $user): bool
    {
        return $this->userRepository->delete($user->id);
    }

    function show(User $user): User
    {
        return $this->userRepository->findById($user->id);
    }
}
