export const activeLinks = (links: string, link: string) => {

    // Escape karakter khusus dalam link untuk regex
    const escapedLink = links.replace(/[-\/\\^$.*+?()[\]{}|]/g, '\\$&');

    // Buat regex untuk mencocokkan kata "link"
    const active = new RegExp(`\\b${escapedLink}\\b`);

    // Cek jika link adalah "home"
    if (link == "/" && links == "home") {
        return true
    }

    const test = active.test(link);
    return test
}
