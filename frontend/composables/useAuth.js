import http from '../config/http'

export async function login (email, password) {

  const route = useRouter()

  try {
    const response = await http.post('/login', {
      email,
      password,
    })

    const token = response.data.laranuxt_session
    const user = response.data.data.name
    const role = response.data.data.role

    sessionStorage.setItem('laranuxt_session', token)
    sessionStorage.setItem('user', user)
    sessionStorage.setItem('role', role)

    route.push('/home')
  } catch (error) {
    if (error.response.status === 401) {
      throw new Error('Credenciais incorretas')
    }

    throw new Error('Algo deu errado')
  }
}
