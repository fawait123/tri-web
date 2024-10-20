import { ArrowDown, ArrowRight, ArrowUp, Check, Circle, Cross, FileQuestion, StopCircle } from 'lucide-vue-next'
import { h } from 'vue'

export const labels = [
    {
        value: 'bug',
        label: 'Bug',
    },
    {
        value: 'feature',
        label: 'Feature',
    },
    {
        value: 'documentation',
        label: 'Documentation',
    },
]

export const statuses = [
    {
        value: 'backlog',
        label: 'Backlog',
        icon: h(FileQuestion),
    },
    {
        value: 'todo',
        label: 'Todo',
        icon: h(Circle),
    },
    {
        value: 'in progress',
        label: 'In Progress',
        icon: h(StopCircle),
    },
    {
        value: 'done',
        label: 'Done',
        icon: h(Check),
    },
    {
        value: 'canceled',
        label: 'Canceled',
        icon: h(Cross),
    },
]

export const priorities = [
    {
        value: 'low',
        label: 'Low',
        icon: h(ArrowDown),
    },
    {
        value: 'medium',
        label: 'Medium',
        icon: h(ArrowRight),
    },
    {
        value: 'high',
        label: 'High',
        icon: h(ArrowUp),
    },
]
