<?php
namespace App\Controller;

use App\Entity\Usuarios;
use App\Repository\UsuariosRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LoginController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/login', name: 'login', methods: ['GET', 'POST'])]
    public function login(Request $request, UsuariosRepository $usuariosRepository): Response
    {
        if ($request->isMethod('POST')) {
            $usuario = $request->request->get('_username');
            $contrasenia = $request->request->get('_password');

            $user = $usuariosRepository->findOneByUsuario($contrasenia);

            if ($user && password_verify($password, $user->getContrasenia())) {
                // Usuario y contraseña correctos, redirigir al usuario a la página de avisos
                return $this->redirectToRoute('app_avisos_index', [], Response::HTTP_SEE_OTHER);
            } else {
                // Usuario y/o contraseña incorrectos, puedes mostrar un mensaje de error o volver a mostrar el formulario de inicio de sesión
                return $this->render('login/login.html.twig', [
                    'error_message' => 'Usuario y/o contraseña incorrectos',
                ]);
            }
        }

        // Si se está accediendo a la página de inicio de sesión a través de GET, simplemente muestra el formulario de inicio de sesión
    }
}