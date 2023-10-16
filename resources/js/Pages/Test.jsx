import React, { useState } from 'react';

const Test = ({foo}) => {
    return (
        <>
            <h1 className='text-3xl font-bold underline'>Hello world</h1>
            <p>{foo}</p>
        </>
    )
}

export default Test