import { Component } from "vue";

export interface IMenu {
    link: string,
    label: string,
    icon: Component,
    activeLink: string
}
