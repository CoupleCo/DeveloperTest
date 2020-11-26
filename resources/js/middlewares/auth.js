export default function auth() {
  if (!localStorage.getItem('token')) {
    return false
  }

  return true
}