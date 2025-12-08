export function examTimeRangeChecker(start, end) {
    const now = new Date()
    return now >= new Date(start) && now <= new Date(end)
}

export function examTimeStartChecker(start) {
    const now = new Date()
    return now < new Date(start)
}

export function examTimeEndChecker(end) {
    const now = new Date()
    return now > new Date(end)
}
